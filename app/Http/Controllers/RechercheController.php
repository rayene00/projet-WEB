<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RechercheController extends Controller
{
    public function index(Request $request)
    {
        $keywords = trim($request->input('keywords', ''));
        $location = trim($request->input('location', ''));
        $search_users = trim($request->input('search_users', ''));

        $stageResults = null;
        $userResults = null;

        // Recherche de stages
        if (!empty($keywords) || !empty($location)) {
            $query = DB::table('offre_de_stage as os')
                ->leftJoin('entreprise as e', 'os.entreprise_id', '=', 'e.id')
                ->select('os.*', 'e.nom as nom_entreprise');

            if (!empty($keywords)) {
                $query->where(function ($q) use ($keywords) {
                    $q->where('os.titre', 'like', "%$keywords%")
                      ->orWhere('os.categorie', 'like', "%$keywords%");
                });
            }

            if (!empty($location)) {
                $query->where(function ($q) use ($location) {
                    $q->where('os.ville', 'like', "%$location%")
                      ->orWhere('os.code_postal', 'like', "%$location%");
                });
            }

            $stageResults = $query->get();
        }

        // Recherche d'utilisateurs
        if (!empty($search_users)) {
            $userResults = DB::table('utilisateur')
                ->select('prenom', 'nom', 'email', 'telephone', 'photo_profil')
                ->where('nom', 'like', "%$search_users%")
                ->orWhere('prenom', 'like', "%$search_users%")
                ->get();
        }

        return view('recherche', compact('keywords', 'location', 'search_users', 'stageResults', 'userResults'));
    }
}