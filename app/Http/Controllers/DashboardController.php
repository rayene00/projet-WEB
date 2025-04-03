<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect()->route('signin'); // Redirection si non connecté
        }

        // Récupération des infos utilisateur
        $user = DB::table('utilisateur')
            ->select('nom', 'prenom', 'email', 'telephone', 'photo_profil')
            ->where('id', $userId)
            ->first();

        // Récupération de l'historique des candidatures
        $candidatures = DB::table('candidature as c')
            ->join('offre_de_stage as o', 'c.offre_id', '=', 'o.id')
            ->join('entreprise as e', 'o.entreprise_id', '=', 'e.id')
            ->where('c.utilisateur_id', $userId)
            ->orderByDesc('c.date_candidature')
            ->select('c.date_candidature', 'o.titre', 'e.nom as entreprise')
            ->get();

        return view('dashboard', [
            'user' => $user,
            'candidatures' => $candidatures
        ]);
    }
}