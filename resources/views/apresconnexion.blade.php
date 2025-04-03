<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CRYF - Trouver un Stage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/firstpage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    {{-- HEADER --}}
    @include('layouts.header')

    {{-- HERO --}}
    <section class="hero">
        <h1>Trouver le <span class="highlight">stage</span> de vos rêves, en toute simplicité</h1>
        <form action="{{ route('offres') }}" method="GET" class="search-bar">
            <input type="text" name="keyword" placeholder="Poste, mots clés...">
            <input type="text" name="location" placeholder="Ville, code postal...">
            <button type="submit" class="btn rechercher">Rechercher</button>
        </form>
    </section>

    {{-- PARTENAIRES --}}
    <section class="partenaires">
        <p>Entreprises avec lesquelles nous travaillons :</p>
        <div class="logos">
            @php
                $logos = [
                    'Airbus' => asset('assets/images/airbus.png'),
                    'Total' => asset('assets/images/total.png'),
                    'Vinci' => asset('assets/images/vinci.png'),
                    'Orange' => asset('assets/images/orange.png'),
                ];
            @endphp

            @foreach ($logos as $nom => $logo)
                <a href="#" class="partenaire-logo">
                    <img src="{{ $logo }}" alt="Logo {{ $nom }}">
                </a>
            @endforeach
        </div>
    </section>

    {{-- FOOTER --}}
    @include('layouts.footer')

</body>
</html>