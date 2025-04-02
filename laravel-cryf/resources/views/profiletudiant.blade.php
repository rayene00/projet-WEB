@extends('layouts.base')

@section('title', 'Profil Étudiant')

@section('styles')
<link rel="stylesheet" href="{{ asset('CSS/profiletudiant.css') }}">
@endsection

@section('content')
<div class="profil-container">
    <h1>Mon Profil Étudiant</h1>

    {{-- Informations personnelles --}}
    <div class="profil-info card">
        <h2>Mes informations</h2>
        <ul>
            <li><strong>Nom :</strong> {{ Auth::user()->nom }}</li>
            <li><strong>Prénom :</strong> {{ Auth::user()->prenom }}</li>
            <li><strong>Email :</strong> {{ Auth::user()->email }}</li>
        </ul>
    </div>

    {{-- Candidatures envoyées --}}
    <div class="profil-candidatures card">
        <h2>Mes candidatures</h2>

        @php
            $candidatures = DB::table('candidature')
                ->join('offre_de_stage', 'offre_de_stage.id', '=', 'candidature.offre_id')
                ->where('utilisateur_id', Auth::id())
                ->orderByDesc('candidature.date_candidature')
                ->select('offre_de_stage.titre', 'offre_de_stage.ville', 'candidature.date_candidature')
                ->get();
        @endphp

        @if ($candidatures->isEmpty())
            <p>Vous n’avez encore postulé à aucune offre.</p>
        @else
            <ul>
                @foreach ($candidatures as $c)
                    <li>
                        <strong>{{ $c->titre }}</strong> – {{ $c->ville }} <br>
                        <small>Postulé le {{ \Carbon\Carbon::parse($c->date_candidature)->format('d/m/Y') }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Action --}}
    <div class="profil-actions">
        <a href="{{ route('offres') }}" class="btn">Voir des offres</a>
    </div>
</div>
@endsection