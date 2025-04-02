<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostulerController extends Controller
{
    public function show($offre_id)
    {
        return view('postuler', ['offre_id' => $offre_id]);
    }

    public function submit(Request $request, $offre_id)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
            'lettre_motivation' => 'required|mimes:pdf|max:2048',
        ]);

        try {
            $cvPath = $request->file('cv')->store('cv', 'public');
            $lettrePath = $request->file('lettre_motivation')->store('lettres', 'public');

            DB::table('candidature')->insert([
                'date_candidature' => now(),
                'cv' => 'storage/' . $cvPath,
                'lettre_motivation' => 'storage/' . $lettrePath,
                'offre_id' => $offre_id,
                'utilisateur_id' => Auth::id(),
            ]);

            return redirect()->route('zoomo', ['id' => $offre_id, 'success' => 1]);

        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
}