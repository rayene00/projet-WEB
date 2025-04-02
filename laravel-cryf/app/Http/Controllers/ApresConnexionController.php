<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApresConnexionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Si l'utilisateur n'est pas connecté, on le redirige
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté');
        }

        // Récupérer les candidatures avec jointures
        $candidatures = DB::table('candidature')
            ->join('offre_de_stage', 'candidature.offre_id', '=', 'offre_de_stage.id')
            ->join('entreprise', 'offre_de_stage.entreprise_id', '=', 'entreprise.id')
            ->select('offre_de_stage.titre', 'entreprise.nom as entreprise_nom', 'candidature.date_candidature')
            ->where('candidature.utilisateur_id', $user->id)
            ->get();

        return view('apresconnexion', ['candidatures' => $candidatures]);
    }
}