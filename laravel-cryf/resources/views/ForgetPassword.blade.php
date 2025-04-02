<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRYF - Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="{{ asset('css/ForgetPassword.css') }}">
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
                <a href="{{ url('/signup') }}" class="btn inscription">Inscription</a>
                <a href="{{ url('/signin') }}" class="btn connexion">Se connecter</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Réinitialiser votre mot de passe</h2>
        <br>

        @if(session('error_message'))
            <div class="error-message">
                {{ session('error_message') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/forgetpassword') }}">
            @csrf
            <div class="form-group">
                <p class="reset-instructions">
                    Veuillez indiquer l'email utilisé pour vous connecter.<br>
                    Si nous trouvons un compte associé, nous vous enverrons des instructions pour réinitialiser votre mot de passe.
                </p>
            </div>

            <div class="form-group email-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="exemple@xxx.com" required>
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
                        
            <button type="submit" class="btn" disabled>Envoyer les instructions de réinitialisation</button>

            <p class="login-link">Vous vous souvenez de votre mot de passe ? <a href="{{ url('/signin') }}">Se connecter</a></p>
        </form>
    </div>

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
                    <li><a href="{{ url('/quisommesnous') }}">Qui sommes-nous ?</a></li>
                    <li><a href="{{ route('avis') }}">Avis</a></li>                    
                    <li><a href="{{ url('/mentions') }}">Mentions légales</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Liens utiles</h3>
                <ul>
                    <li><a href="{{ url('/offres') }}">Offre de stage</a></li>
                    <li><a href="{{ route('cgu') }}">Conditions d'Utilisation</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="footer-alertes">
                <form action="{{ url('/newsletter') }}" method="POST" class="newsletter">
                    @csrf
                    <input type="email" name="email" placeholder="exemple@xxx.com" required>
                    <button type="submit" class="btn">Inscription</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p>2025 @ CRYF. All rights reserved.</p>
            <div class="social-icons">
                @php
                    $social_links = [
                        'facebook-f' => 'https://www.facebook.com/',
                        'instagram' => 'https://www.instagram.com/',
                        'linkedin-in' => 'https://www.linkedin.com/',
                        'twitter' => 'https://x.com/home?lang=en'
                    ];
                @endphp

                @foreach ($social_links as $icon => $link)
                    <a href="{{ $link }}" target="_blank"><i class="fa-brands fa-{{ $icon }}"></i></a>
                @endforeach
            </div>
        </div>
    </footer>    

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxArea = document.getElementById('checkbox-area');
            const spinner = document.getElementById('spinner');
            const checkIcon = document.getElementById('check-icon');
            const submitBtn = document.querySelector('button[type="submit"]');

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
</body>
</html>