<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $entreprises = DB::table('entreprise as e')
            ->leftJoin('avis as a', 'e.id', '=', 'a.entreprise_id')
            ->select(
                'e.id',
                'e.nom',
                DB::raw('COUNT(a.id) as nombre_avis'),
                DB::raw('ROUND(AVG(a.note_avis), 1) as moyenne_notes')
            )
            ->when($search, function ($query, $search) {
                return $query->where('e.nom', 'like', '%' . $search . '%');
            })
            ->groupBy('e.id', 'e.nom')
            ->orderByRaw($search ? 'e.nom ASC' : 'nombre_avis DESC')
            ->limit($search ? null : 6)
            ->get();

        $logos = [
            'Airbus' => '../assets/images/airbusavis.png',
            'Total' => '../assets/images/total.png',
            'Vinci' => '../assets/images/vinci.png',
            'Orange' => '../assets/images/orange.jpg',
            'Google' => '../assets/images/google.webp',
            'Microsoft' => '../assets/images/microsoft.png',
            'Apple' => '../assets/images/Apple_logo_black.png',
            'Amazon' => '../assets/images/amazon.jpg',
            'IBM' => '../assets/images/IBM_logo.svg.png',
            'Intel' => '../assets/images/Intel_logo_(2006-2020).svg.png',
            'Nvidia' => '../assets/images/nvidia.png',
            'Siemens' => '../assets/images/siemens.png',
            'Samsung' => '../assets/images/samsung.png',
            'CIC' => '../assets/images/CICavis.png',
            'Schneider' => '../assets/images/Schneideravis.jpg',
            'SFR' => '../assets/images/SFRavis.png',
            'Tesla' => '../assets/images/tesla.png'
                ];

        return view('avis', [
            'entreprises' => $entreprises,
            'search' => $search,
            'logos' => $logos
        ]);
    }

    public function store(Request $request)
    {
        $entreprise_id = $request->input('entreprise_id');
        $note = $request->input('note');
        $description = trim($request->input('description_avis'));

        $validated = $request->validate([
            'entreprise_id' => 'required|integer|exists:entreprise,id',
            'note' => 'required|integer|min:1|max:5',
            'description_avis' => 'nullable|string|max:450',
        ]);

        try {
            DB::table('avis')->insert([
                'description_avis' => $description,
                'note_avis' => $note,
                'entreprise_id' => $entreprise_id,
                'date_avis' => now(),
            ]);

            return redirect()->route('zoomentreprise', ['id' => $entreprise_id, 'success' => 1]);

        } catch (\Exception $e) {
            return redirect()->route('zoomentreprise', ['id' => $entreprise_id, 'error' => 1]);
        }
    }
}