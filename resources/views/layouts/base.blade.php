<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('CSS/app.css') }}">
    @yield('styles')
</head>
<body>

    {{-- Header utilisé dans firstpage --}}
    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    {{-- Footer utilisé dans firstpage --}}
    @include('layouts.footer')

</body>
</html>