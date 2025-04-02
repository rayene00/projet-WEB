<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CRYF')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSS global optionnel --}}
    {{-- <link rel="stylesheet" href="{{ asset('CSS/app.css') }}"> --}}

    {{-- CSS spécifique à chaque page --}}
    @yield('styles')
</head>
<body>

    @include('layouts.header')

    <main class="main-content">
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Scripts JS si besoin -->
    @yield('scripts')
</body>
</html>
