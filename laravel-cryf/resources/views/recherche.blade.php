@extends('layouts.header') {{-- Assure-toi d’avoir un layouts/base.blade.php avec @yield('content') --}}

@section('title', 'Recherche - CRYF')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/recherche.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')

<header>
    <div class="header-container">
        <div class="logo-section">
            <a href="{{ route('firstpage') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="CRYF Logo" class="logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>
        <nav>
            <a href="#" class="access-recruteur">Accès Recruteur ></a>
            <a href="{{ route('signup') }}" class="btn inscription">Inscription</a>
            <a href="{{ route('signin') }}" class="btn connexion">Se connecter</a>
        </nav>
    </div>
</header>

<main class="container">
    <div class="search-sections">

        <!-- Recherche de stages -->
        <section class="stages-search">
            <h2>Rechercher un stage</h2>
            <form action="{{ route('recherche') }}" method="GET" class="search-bar">
                <input type="text" name="keywords" placeholder="Catégories, mots clés..." value="{{ old('keywords', $keywords) }}">
                <input type="text" name="location" placeholder="Ville, code postal..." value="{{ old('location', $location) }}">
                <button type="submit" class="btn rechercher">Rechercher un stage</button>
            </form>
        </section>

        <!-- Recherche d'utilisateurs -->
        <section class="users-search">
            <h2>Rechercher un utilisateur</h2>
            <form action="{{ route('recherche') }}" method="GET" class="search-bar">
                <input type="text" name="search_users" placeholder="Nom ou prénom..." value="{{ old('search_users', $search_users) }}">
                <button type="submit" class="btn rechercher">Rechercher un utilisateur</button>
            </form>
        </section>
    </div>

    <!-- Résultats stages -->
    @if ($stageResults !== null)
    <section class="results-container stages-results">
        <h2>Résultats des stages</h2>
        @forelse ($stageResults as $row)
            <div class="stage-card">
                <h3>{{ $row->titre }}</h3>
                <p class="entreprise">{{ $row->nom_entreprise ?? 'Entreprise inconnue' }}</p>
                <p class="location">{{ $row->ville }} ({{ $row->code_postal }})</p>
                <p class="categorie">{{ $row->categorie }}</p>
                <p class="description">{{ $row->description }}</p>
                <p class="duree">Durée : {{ $row->duree_du_stage }} mois</p>
                <a href="{{ url('zoomoffre.php?id=' . $row->id) }}" class="btn voir-plus">Voir plus</a>
            </div>
        @empty
            <div class="no-results">
                <p>Aucun stage ne correspond à vos critères.</p>
            </div>
        @endforelse
    </section>
    @endif

    <!-- Résultats utilisateurs -->
    @if ($userResults !== null)
    <section class="results-container users-results">
        <h2>Résultats des utilisateurs</h2>
        @forelse ($userResults as $user)
            <div class="user-card">
                <div class="user-avatar">
                    <img src="{{ $user->photo_profil ? asset('uploads/' . $user->photo_profil) : asset('assets/images/logoProfil.jpg') }}" alt="Photo de profil">
                </div>
                <div class="user-info">
                    <h3>{{ $user->prenom }} {{ $user->nom }}</h3>
                    <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                    @if ($user->telephone)
                        <p><i class="fas fa-phone"></i> {{ $user->telephone }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="no-results">
                <p>Aucun utilisateur trouvé.</p>
            </div>
        @endforelse
    </section>
    @endif
</main>

@include('layouts.footer')

@endsection
