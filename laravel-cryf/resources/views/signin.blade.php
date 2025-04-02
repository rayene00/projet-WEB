<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - CRYF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Feuilles de style --}}
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    {{-- HEADER --}}
    @include('layouts.header')

    {{-- CONTENU PRINCIPAL --}}
    <div class="container">
        <h2>Connexion</h2>

        @if (session('message'))
            <p class="form-message">{{ session('message') }}</p>
        @endif

        <form method="POST" action="{{ route('signin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" placeholder="Votre email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" placeholder="Votre mot de passe" required>
            </div>

            <a href="{{ route('forgetpassword') }}" class="forgot-password">Mot de passe oublié ?</a>

            <button type="submit" class="btn submit">Se connecter</button>
        </form>

        <p class="register-link">
            Pas encore de compte ?
            <a href="{{ route('signup') }}">S'inscrire ici</a>
        </p>
    </div>

    {{-- FOOTER --}}
    @include('layouts.footer')

</body>
</html>