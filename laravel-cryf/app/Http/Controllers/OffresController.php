<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffresController extends Controller
{
    public function index(Request $request)
    {
        $categoriesList = [
            "Design", "Ventes", "Marketing", "Business",
            "Ressources humaines", "Finance", "Ingénierie",
            "Technologie", "Energie", "Communication"
        ];

        $selectedCategories = $request->input('categories', []);
        $selectedDurees = $request->input('duree', []);

        // Requête principale
        $query = DB::table('offre_de_stage')
            ->join('entreprise', 'offre_de_stage.entreprise_id', '=', 'entreprise.id')
            ->select('offre_de_stage.*', 'entreprise.nom as nom_entreprise');

        if (!empty($selectedCategories)) {
            $query->whereIn('offre_de_stage.categorie', $selectedCategories);
        }

        if (!empty($selectedDurees)) {
            $query->where(function($q) use ($selectedDurees) {
                foreach ($selectedDurees as $duree) {
                    if ($duree === '1-3') {
                        $q->orWhereBetween('offre_de_stage.duree_du_stage', [1, 3]);
                    } elseif ($duree === '3-6') {
                        $q->orWhereBetween('offre_de_stage.duree_du_stage', [3, 6]);
                    } elseif ($duree === '6+') {
                        $q->orWhere('offre_de_stage.duree_du_stage', '>=', 6);
                    }
                }
            });
        }

        $offres = $query->get();

        // Compter les catégories pour affichage à gauche
        $categoryCounts = DB::table('offre_de_stage')
            ->select('categorie', DB::raw('count(*) as count'))
            ->groupBy('categorie')
            ->pluck('count', 'categorie')
            ->toArray();

        return view('offres', [
            'offres' => $offres,
            'categoriesList' => $categoriesList,
            'selectedCategories' => $selectedCategories,
            'selectedDurees' => $selectedDurees,
            'categoryCounts' => $categoryCounts,
        ]);
    }
}