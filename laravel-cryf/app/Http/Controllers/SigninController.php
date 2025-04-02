<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SigninController extends Controller
{
    public function show()
    {
        // Si l'utilisateur est déjà connecté, le rediriger vers apresconnexion
        if (Session::has('user_id')) {
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

        $user = DB::table('utilisateur')->where('email', $email)->first();

        if ($user && password_verify($password, $user->mot_de_passe)) {
            // Stocker les informations de l'utilisateur en session
            Session::put('user_id', $user->id);
            Session::put('prenom', $user->prenom);
            Session::put('nom', $user->nom);
            Session::put('email', $user->email);
            Session::put('role_id', $user->role_id);

            // Rediriger vers la page après connexion
            return redirect()->route('apresconnexion')->with('success', 'Connexion réussie !');
        }

        return back()->with('message', 'Adresse email ou mot de passe incorrect.');
    }

    public function logout()
    {
        // Détruire la session
        Session::flush();
        
        // Rediriger vers la page de connexion
        return redirect()->route('signin')->with('message', 'Vous avez été déconnecté.');
    }
}