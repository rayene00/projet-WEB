<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    @include('layouts.header')

    <div class="container">
        <h2>Inscription</h2>
        <br>

        @if(session('message'))
            <p class="form-message">{{ session('message') }}</p>
        @endif

        <form method="POST" action="{{ route('signup.register') }}">
            @csrf
            <div class="form-row">
                <div class="form-group prenom-group">
                    <label>Prénom *</label>
                    <input type="text" name="prenom" placeholder="Prénom" required>
                </div>
                <div class="form-group nom-group">
                    <label>Nom *</label>
                    <input type="text" name="nom" placeholder="Nom" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group email-group">
                    <label>Adresse courriel *</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group telephone-group">
                    <label>Téléphone *</label>
                    <input type="tel" name="telephone" placeholder="Téléphone" required>
                </div>
            </div>

            <div class="form-group role-group">
                <label>Vous êtes *</label>
                <div class="checkbox-group">
                    <input type="radio" id="pilote" name="role" value="2" required>
                    <label for="pilote">Pilote</label>
                    <input type="radio" id="etudiant" name="role" value="1">
                    <label for="etudiant">Étudiant</label>
                </div>
            </div>

            <div class="form-group entreprise-group" id="entreprise-container" style="display: none;">
                <label>Nom de l'entreprise (pilote) *</label>
                <input type="text" name="entreprise" placeholder="Nom de l'entreprise" id="entreprise-input">
            </div>

            <h4>Sécurité du Compte</h4>
            <div class="form-row">
                <div class="form-group password-group">
                    <label>Mot de passe *</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group confirm-password-group">
                    <label>Confirmer le mot de passe *</label>
                    <input type="password" name="confirm_password" required>
                </div>
            </div>

            <div class="form-group-terms-group-checkbox-group">
                <div>
                    <input type="checkbox" id="terms" required>
                    <label for="terms">J'accepte les conditions d'utilisateur</label>
                </div>
                <a href="{{ route('cgu') }}" class="terms-link">Lire les CGU</a>
            </div>

            <button type="submit" class="btn">S'inscrire</button>

            <p class="login-link">Déjà inscrit ? <a href="{{ route('signin') }}">Se connecter</a></p>
        </form>
    </div>

    @include('layouts.footer')

    <script>
        const piloteRadio = document.getElementById("pilote");
        const etudiantRadio = document.getElementById("etudiant");
        const entrepriseContainer = document.getElementById("entreprise-container");
        const entrepriseInput = document.getElementById("entreprise-input");

        function toggleEntrepriseField() {
            entrepriseContainer.style.display = piloteRadio.checked ? "block" : "none";
            entrepriseInput.required = piloteRadio.checked;
        }

        piloteRadio.addEventListener("change", toggleEntrepriseField);
        etudiantRadio.addEventListener("change", toggleEntrepriseField);
    </script>
</body>
</html>
