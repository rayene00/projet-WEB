<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Important : il faut un modèle User

class SigninController extends Controller
{
    public function show()
    {
        // Si l'utilisateur est déjà connecté via Laravel Auth
        if (Auth::check()) {
            return redirect()->route('apresconnexion');
        }
        return view('signin');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($email) || empty($password)) {
            return back()->with('message', 'Veuillez remplir tous les champs.');
        }

        // Chercher l'utilisateur manuellement
        $user = DB::table('utilisateur')->where('email', $email)->first();

        if ($user && password_verify($password, $user->mot_de_passe)) {
            // Connecter l'utilisateur avec Laravel Auth
            Auth::loginUsingId($user->id);

            // Stocker d'autres infos en session (optionnel)
            Session::put('prenom', $user->prenom);
            Session::put('nom', $user->nom);
            Session::put('email', $user->email);
            Session::put('role_id', $user->role_id);

            return redirect()->route('apresconnexion')->with('success', 'Connexion réussie !');
        }

        return back()->with('message', 'Adresse email ou mot de passe incorrect.');
    }

    public function logout()
    {
        Auth::logout(); // Déconnexion propre
        Session::flush(); // On vide les infos de session

        return redirect()->route('signin')->with('message', 'Vous avez été déconnecté.');
    }
}