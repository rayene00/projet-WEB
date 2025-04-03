<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZoomEntrepriseController extends Controller
{
    public function show($id)
    {
        $entreprise = DB::table('entreprise')->where('id', $id)->first();
        if (!$entreprise) {
            abort(404, 'Entreprise non trouvée');
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

        $stats = DB::table('avis')
            ->where('entreprise_id', $id)
            ->selectRaw('COUNT(*) as nombre_avis, ROUND(AVG(note_avis), 1) as moyenne_notes')
            ->first();

        $avis = DB::table('avis')
            ->where('entreprise_id', $id)
            ->orderByDesc('date_avis')
            ->get();

        $offres = DB::table('offre_de_stage')
            ->where('entreprise_id', $id)
            ->orderByDesc('date_creation')
            ->get();

        return view('zoomentreprise', [
            'entreprise' => $entreprise,
            'logos' => $logos,
            'stats' => $stats,
            'avis' => $avis,
            'offres' => $offres,
        ]);
    }
}