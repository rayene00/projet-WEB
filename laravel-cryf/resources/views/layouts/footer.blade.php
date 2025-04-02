<footer>
    <div class="footer-container">

        <!-- Logo -->
        <div class="footer-logo">
            <a href="{{ route('firstpage') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="CRYF Logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>

        <!-- À propos -->
        <div class="footer-section">
            <h3>À propos</h3>
            <ul>
                <li><a href="{{ route('quisommesnous') }}">Qui sommes-nous ?</a></li>
                <li><a href="{{ route('avis') }}">Avis</a></li>                    
                <li><a href="{{ route('mentions') }}">Mentions légales</a></li>                   
            </ul>
        </div>

        <!-- Liens utiles -->
        <div class="footer-section">
            <h3>Liens utiles</h3>
            <ul>
                <li><a href="{{ route('offres') }}">Offres de stage</a></li>
                <li><a href="{{ route('cgu') }}">Conditions d'utilisation</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <!-- Alerte stages -->
        <div class="footer-alertes">
            <h3>Alertes de stages</h3>
            <p>Les dernières offres de stages envoyées par mail chaque semaine.</p>
            <form action="#" method="POST" class="newsletter">
                <input type="email" name="email" placeholder="exemple@xxx.com" required>
                <button type="submit" class="btn">Inscription</button>
            </form>
        </div>
    </div>

    <!-- Bas de page -->
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