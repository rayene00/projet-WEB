<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZoomOffreController extends Controller
{
    public function show($id)
    {
        $offre = DB::table('offre_de_stage as o')
            ->leftJoin('entreprise as e', 'o.entreprise_id', '=', 'e.id')
            ->select(
                'o.*',
                'e.nom as nom_entreprise',
                'e.description as description_entreprise',
                'e.id as entreprise_id'
            )
            ->where('o.id', $id)
            ->first();

        if (!$offre) {
            return redirect()->route('offres')->with('error', 'Offre introuvable.');
        }

        $logos = [
            'Airbus' => 'assets/images/airbusavis.png',
            'Total' => 'assets/images/total.png',
            'Vinci' => 'assets/images/vinci.png',
            'Orange' => 'assets/images/orange.jpg',
            'Google' => 'assets/images/google.webp',
            'Microsoft' => 'assets/images/microsoft.png',
            'Apple' => 'assets/images/Apple_logo_black.png',
            'Amazon' => 'assets/images/amazon.jpg',
            'Facebook' => 'assets/images/facebook.png',
            'IBM' => 'assets/images/IBM_logo.svg.png',
            'Intel' => 'assets/images/Intel_logo_(2006-2020).svg.png',
            'Nvidia' => 'assets/images/nvidia.png',
            'Siemens' => 'assets/images/siemens.png',
            'Samsung' => 'assets/images/samsung.png',
            'CIC' => 'assets/images/CICavis.png',
            'Schneider' => 'assets/images/Schneideravis.jpg',
            'SFR' => 'assets/images/SFRavis.png',
            'Tesla' => 'assets/images/tesla.png',
        ];

        return view('zoomoffre', [
            'offre' => $offre,
            'logo' => $logos[$offre->nom_entreprise] ?? 'assets/images/logoProfil.jpg'
        ]);
    }
}