@extends('layouts.base')

@section('title', 'Profil Pilote')
@section('styles')
<link rel="stylesheet" href="{{ asset('CSS/profilpilote.css') }}">
@endsection


@section('content')
<div class="profil-container">
    <h1>Mon Espace Pilote</h1>

    {{-- Informations personnelles --}}
    <div class="card">
        <h2>Mes informations</h2>
        <ul>
            <li><strong>Nom :</strong> {{ Auth::user()->nom }}</li>
            <li><strong>Prénom :</strong> {{ Auth::user()->prenom }}</li>
            <li><strong>Email :</strong> {{ Auth::user()->email }}</li>
        </ul>
    </div>

    {{-- Liste des étudiants --}}
    <div class="card">
        <h2>Étudiants enregistrés</h2>

        @php
            $etudiants = DB::table('utilisateurs')
                ->where('role', 'etudiant')
                ->select('nom', 'prenom', 'email')
                ->orderBy('nom')
                ->get();
        @endphp

        @if ($etudiants->isEmpty())
            <p>Aucun étudiant trouvé.</p>
        @else
            <ul>
                @foreach ($etudiants as $e)
                    <li>
                        {{ $e->prenom }} {{ $e->nom }} – {{ $e->email }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Accès rapides --}}
    <div class="profil-actions">
        <a href="{{ route('offres') }}" class="btn">Voir les offres</a>
        <a href="{{ route('avis') }}" class="btn" style="margin-left: 10px;">Voir les avis</a>
    </div>
</div>
@endsection