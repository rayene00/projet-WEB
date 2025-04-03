<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Qui sommes-nous ? - CRYF</title>
    <link rel="stylesheet" href="{{ asset('css/quisommesnous.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo-section">
            <a href="{{ route('firstpage') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="CRYF Logo" class="logo">
                <span class="brand-name">CRYF</span>
            </a>
        </div>
        <nav>
            <a href="#" class="btn inscription">Inscription</a>
            <a href="#" class="btn connexion">Se connecter</a>
        </nav>
    </div>
</header>

<section class="full-width-images">
    <div class="image-container">
        <img src="{{ asset('assets/images/1er_Qui_sommes_nous.png') }}" alt="Image 1" class="full-width-image">
        <div class="image-overlay"></div>
        <div class="image-content">
            <h2 class="title-underline">Qui sommes nous ?</h2>
        </div>
    </div>

    <div class="image-container">
        <img src="{{ asset('assets/images/2eme_Qui_sommes_nous.png') }}" alt="Image 2" class="full-width-image">
        <div class="image-overlay"></div>
        <div class="image-content">
            <p class="larger-text">Notre objectif est de simplifier la recherche de stage pour les étudiants...</p>
        </div>
    </div>

    <div class="image-container">
        <img src="{{ asset('assets/images/3eme_Qui_sommes_nous.png') }}" alt="Image 3" class="full-width-image">
        <div class="image-overlay"></div>
        <div class="image-content">
            <p class="larger-text">Chez CRYF, nous nous engageons à fournir une interface moderne et responsive...</p>
        </div>
    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <a href="{{ route('firstpage') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="CRYF Logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>

        <div class="footer-section">
            <h3>A propos</h3>
            <ul>
                <li><a href="{{ route('quisommesnous') }}">Qui sommes-nous ?</a></li>
                <li><a href="{{ route('avis') }}">Avis</a></li>
                <li><a href="{{ route('mentions') }}">Mentions légales</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Liens utiles</h3>
            <ul>
                <li><a href="{{ route('offres') }}">Offre de stage</a></li>
                <li><a href="{{ route('cgu') }}">Conditions d'Utilisations</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <div class="footer-alertes">
            <h3>Alertes de stages</h3>
            <p>Les dernières offres de stages envoyées par mail chaque semaine.</p>
            <div class="newsletter">
                <input type="email" placeholder="exemple@xxx.com">
                <button class="btn">Inscription</button>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>2025 @ CRYF. All rights reserved.</p>
        <div class="social-icons">
            <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.linkedin.com/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="https://x.com/home?lang=en" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </div>
</footer>

</body>
</html>