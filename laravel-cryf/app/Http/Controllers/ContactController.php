<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function envoyer(Request $request)
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        DB::table('contact')->insert($validated);

        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès !');
    }
}
