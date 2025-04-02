<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe - CRYF</title>
    <link rel="stylesheet" href="{{ asset('css/resetpassword.css') }}">
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
                <a href="{{ route('signup') }}" class="btn inscription">Inscription</a>
                <a href="{{ route('signin') }}" class="btn connexion">Se connecter</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Réinitialiser votre mot de passe</h2>
        <p class="instructions">Veuillez entrer votre nouveau mot de passe.</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('resetpassword') }}">
            @csrf
            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label>Confirmation du mot de passe</label>
                <input type="password" name="confirm_password" required>
            </div>
            <div class="form-group captcha-group">
                <div class="recaptcha" id="recaptcha-box">
                    <div class="checkbox-area" id="checkbox-area">
                        <div class="spinner hidden" id="spinner"></div>
                        <i class="fa-solid fa-check check-icon hidden" id="check-icon"></i>
                    </div>
                    <span>I'm not a robot</span>
                </div>
            </div>
            <button type="submit" class="btn" id="submit-btn" disabled>Confirmer</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxArea = document.getElementById('checkbox-area');
            const spinner = document.getElementById('spinner');
            const checkIcon = document.getElementById('check-icon');
            const submitBtn = document.getElementById('submit-btn');

            let validated = false;
            submitBtn.disabled = true;

            checkboxArea.addEventListener('click', () => {
                if (validated) return;
                spinner.classList.remove('hidden');

                setTimeout(() => {
                    spinner.classList.add('hidden');
                    checkIcon.classList.remove('hidden');
                    validated = true;
                    submitBtn.disabled = false;
                }, 1500);
            });
        });
    </script>
        <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <a href="firstpage.php"><img src="../assets/images/logo.png" alt="CRYF Logo"></a>
                <span class="brand-name">CRYF</span>
            </div>

            <div class="footer-section">
                <h3>A propos</h3>
                <ul>
                    <li><a href="quisommesnous.php">Qui sommes-nous ?</a></li>
                    <li><a href="avis.php">Avis</a></li>
                    <li><a href="mentions.php">Mentions légales</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Liens utiles</h3>
                <ul>
                    <li><a href="offres.php">Offres de stage</a></li>
                    <li><a href="cgu.php">Conditions d'Utilisation</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-alertes">
                <h3>Alertes de stages</h3>
                <p>Les dernières offres de stages envoyées par mail chaque semaine.</p>
                <form action="newsletter.php" method="POST" class="newsletter">
                    <input type="email" name="email" placeholder="exemple@xxx.com" required>
                    <button type="submit" class="btn">Inscription</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p>2025 @ CRYF. All rights reserved.</p>
            <div class="social-icons">
                <?php
                $social_links = [
                    'facebook-f' => 'https://www.facebook.com/',
                    'instagram' => 'https://www.instagram.com/',
                    'linkedin-in' => 'https://www.linkedin.com/',
                    'twitter' => 'https://x.com/home?lang=en'
                ];

                foreach ($social_links as $platform => $url) {
                    echo '<a href="' . htmlspecialchars($url) . '" target="_blank">';
                    echo '<i class="fa-brands fa-' . $platform . '"></i></a>';
                }
                ?>
            </div>
        </div>
    </footer>

</body>
</html>