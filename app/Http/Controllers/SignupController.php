<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SignupController extends Controller
{
    public function show()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'role' => 'required|integer',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $email = $request->email;

        $exists = DB::table('utilisateur')->where('email', $email)->exists();

        if ($exists) {
            return back()->with('message', "Cet email est déjà utilisé.");
        }

        DB::table('utilisateur')->insert([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $email,
            'mot_de_passe' => Hash::make($request->password),
            'role_id' => $request->role,
            'telephone' => $request->telephone,
            'entreprise' => $request->entreprise ?? null,
        ]);

        return back()->with('message', "Inscription réussie. Vous pouvez maintenant <a href='".route('signin')."'>vous connecter</a>.");
    }
}