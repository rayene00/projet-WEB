@extends('layouts.base')

@section('title', 'Avis des entreprises')

@section('styles')
<link rel="stylesheet" href="{{ asset('CSS/avis.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<section class="hero">
    <h1>Trouvez les entreprises qui vous ressemblent !</h1>
    <form method="GET" action="{{ route('avis') }}" class="search-bar">
        <input type="text" name="search" placeholder="Nom de l'entreprise..." value="{{ $search }}">
        <button type="submit" class="btn rechercher">Rechercher</button>
    </form>
</section>

<main class="entreprises-container">
    <h2>{{ $search ? 'Résultats de la recherche' : 'Entreprises les plus recherchées' }}</h2>

    @if($entreprises->isEmpty())
        <div class="no-results">
            <p>Aucune entreprise trouvée pour "{{ $search }}"</p>
        </div>
    @else
        <div class="cards-container">
            @foreach($entreprises as $e)
                <div class="card">
                <img src="{{ asset($logos[$e->nom] ?? 'assets/images/default.png') }}" alt="Logo {{ $e->nom }}">
                <div class="card-info">
                        <h3>{{ $e->nom }}</h3>
                        <div class="rating">
                            <span class="stars">
                                @php $note = floatval($e->moyenne_notes); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $note)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $note)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </span>
                            <span class="reviews">({{ $e->nombre_avis }} avis)</span>
                        </div>
                    </div>
                    <a href="{{ route('zoomentreprise', ['id' => $e->id]) }}" class="btn avis-btn">Voir les avis</a>
                </div>
            @endforeach
        </div>
    @endif
</main>
@endsection