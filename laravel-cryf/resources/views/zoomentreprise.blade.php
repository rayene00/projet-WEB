@extends('layouts.base')

@section('title', 'Entreprise - ' . $entreprise->nom)

@section('styles')
<link rel="stylesheet" href="{{ asset('CSS/zoomentreprise.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<section class="entreprise-section">
    <div class="entreprise-header">
        <div class="entreprise-info card">
            <div class="logo-nom">
                <img src="{{ asset($logos[$entreprise->nom] ?? 'assets/images/default.png') }}" 
                     alt="Logo {{ $entreprise->nom }}" 
                     class="logo-entreprise-large">
                <h1>{{ $entreprise->nom }}</h1>
            </div>
        </div>
        <div class="note card">
            <h3>Note moyenne de l'entreprise</h3>
            <div class="stars">
                @php
                    $moyenne = $stats->moyenne_notes ?? 0;
                    $pleines = floor($moyenne);
                    $demie = ($moyenne - $pleines) >= 0.5;
                @endphp
                @for($i = 0; $i < $pleines; $i++) <i class="fas fa-star"></i> @endfor
                @if($demie) <i class="fas fa-star-half-alt"></i> @endif
                @for($i = $pleines + $demie; $i < 5; $i++) <i class="far fa-star"></i> @endfor
            </div>
        </div>
    </div>

    <div class="entreprise-description">
        <h2>À propos de l'entreprise</h2>
        <p>{{ $entreprise->description }}</p>
    </div>

    <div class="offres-section">
        <h2>Offres liées</h2>
        @forelse($offres as $offre)
            <div class="offre-card">
                <div class="offre-gauche">
                    <img src="{{ asset($logos[$entreprise->nom] ?? 'assets/images/default.png') }}" 
                         alt="{{ $entreprise->nom }}" 
                         class="offre-logo">
                    <div>
                        <h3>{{ $offre->titre }}</h3>
                        <p>{{ $entreprise->nom }} • {{ $offre->ville }}</p>
                        <div class="tags">
                            <span class="tag">{{ $offre->categorie }}</span>
                            <span class="tag">{{ $offre->duree_du_stage }} mois</span>
                            <span class="tag">{{ $offre->ville }} ({{ $offre->code_postal }})</span>
                            <span class="tag">Publié le {{ \Carbon\Carbon::parse($offre->date_creation)->format('d/m/Y') }}</span>
                        </div>
                        <p class="description">{{ $offre->description }}</p>
                    </div>
                </div>
                <a href="{{ route('postuler.show', $offre->id) }}" class="btn postuler">Postuler</a>
            </div>
        @empty
            <p>Aucune offre pour cette entreprise.</p>
        @endforelse
    </div>
</section>

<main>
    <section class="avis-section">
        <div class="avis-form-container">
            <h2>Avis d'étudiants</h2>
            <h3 class="avis-title">Donnez votre avis</h3>
            <form method="POST" action="{{ route('avis.store') }}">
                @csrf
                <input type="hidden" name="entreprise_id" value="{{ $entreprise->id }}">
                <input type="hidden" name="note" id="noteInput" value="0">

                <div class="rating-container">
                    <div class="stars" id="starsContainer">
                        <i class="far fa-star" data-value="1"></i>
                        <i class="far fa-star" data-value="2"></i>
                        <i class="far fa-star" data-value="3"></i>
                        <i class="far fa-star" data-value="4"></i>
                        <i class="far fa-star" data-value="5"></i>
                    </div>
                    <span class="rating-text">Note : <span id="noteText">0</span>/5</span>
                </div>

                <div class="avis-text-container">
                    <textarea name="description_avis" id="avisText"
                              maxlength="450"
                              placeholder="Partagez votre expérience (450 caractères max)"></textarea>
                    <div class="char-count">
                        <span id="charCount">0</span>/450
                    </div>
                </div>

                <button type="submit" class="btn submit-avis">Envoyer l'avis</button>
            </form>
        </div>

        <div class="avis-liste">
            @forelse($avis as $a)
                <div class="avis-card">
                    <div class="rating">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $a->note_avis)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <p>{{ $a->description_avis }}</p>
                    <span class="avis-date">{{ \Carbon\Carbon::parse($a->date_avis)->format('d/m/Y') }}</span>
                </div>
            @empty
                <p>Aucun avis encore.</p>
            @endforelse
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
    const stars = document.querySelectorAll('#starsContainer i');
    const noteInput = document.getElementById('noteInput');
    const noteText = document.getElementById('noteText');
    const avisText = document.getElementById('avisText');
    const charCount = document.getElementById('charCount');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            noteInput.value = value;
            noteText.innerText = value;
            stars.forEach(s => {
                s.classList.remove('fas');
                s.classList.add('far');
            });
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('fas');
                stars[i].classList.remove('far');
            }
        });
    });

    avisText.addEventListener('input', () => {
        charCount.innerText = avisText.value.length;
    });
</script>
@endsection