<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photo = $request->file('photo');
        $filename = 'profil_' . Auth::id() . '.' . $photo->getClientOriginalExtension();
        $path = 'assets/images/' . $filename;

        // Enregistre le fichier dans public/assets/images
        $photo->move(public_path('assets/images'), $filename);

        // Met à jour la BDD
        $user = Auth::user();
        $user->photo_profil = $path;
        $user->save();

        return back()->with('success', 'Photo de profil mise à jour !');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:utilisateur,email,' . Auth::id(),
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        // Vérifie le mot de passe actuel
        if (!Hash::check($request->password, $user->mot_de_passe)) {
            return back()->withErrors([
                'password' => 'Le mot de passe est incorrect.'
            ]);
        }

        // Met à jour les infos
        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil mis à jour avec succès !');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->getAuthPassword())) {
            return back()->withErrors([
                'delete_password' => 'Le mot de passe est incorrect.'
            ]);
        }

        // Supprime l'utilisateur
        $user->delete();

        // Déconnecte l'utilisateur
        Auth::logout();
        $request->session()->flush();

        return redirect()->route('firstpage')
            ->with('success', 'Votre compte a été supprimé avec succès.');
    }
}