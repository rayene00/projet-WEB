@extends('layouts.base')

@section('title', $offre->titre . ' - CRYF')

@section('styles')
<link rel="stylesheet" href="{{ asset('CSS/zoomoffre.css') }}">
<link rel="stylesheet" href="{{ asset('CSS/firstpage.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<main class="offre-details">
    <div class="offre-header">
        <div class="entreprise-info">
            <img src="{{ asset($logo) }}" alt="Logo {{ $offre->nom_entreprise }}" class="entreprise-logo">
            <div class="entreprise-details">
                <h1>{{ $offre->titre }}</h1>
                <p class="entreprise-name">
                    <i class="fas fa-building"></i> {{ $offre->nom_entreprise }}
                </p>
            </div>
        </div>
        
        <div class="offre-meta">
            <div class="tags">
                <span class="tag">
                    <i class="fas fa-map-marker-alt"></i> {{ $offre->ville }} ({{ $offre->code_postal }})
                </span>
                <span class="tag">
                    <i class="fas fa-clock"></i> {{ $offre->duree_du_stage }} mois
                </span>
                <span class="tag">
                    <i class="fas fa-tag"></i> {{ $offre->categorie }}
                </span>
                <span class="tag">
                    <i class="fas fa-calendar"></i>
                    Publié le {{ \Carbon\Carbon::parse($offre->date_publication)->format('d/m/Y') }}
                </span>
            </div>
        </div>
    </div>

    <div class="offre-content">
        <section class="description">
            <h2>Description du poste</h2>
            <div class="description-content">
                {!! nl2br(e($offre->description)) !!}
            </div>
        </section>

        <aside class="actions">
            <a href="{{ route('postuler.show', $offre->id) }}" class="btn postuler">
                <i class="fas fa-paper-plane"></i> Postuler
            </a>
            <a href="{{ route('zoomentreprise', $offre->entreprise_id) }}" class="btn voir-entreprise">
                <i class="fas fa-building"></i> Voir l'entreprise
            </a>
        </aside>
    </div>
</main>
@endsection