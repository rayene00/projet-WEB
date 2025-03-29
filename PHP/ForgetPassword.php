<?php
session_start();

// Traitement du formulaire si soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = "98.66.232.225";
    $username = "groupeweb";
    $password = "mdpgroupe123";
    $dbname = "cryf";

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            throw new Exception("Connexion échouée : " . $conn->connect_error);
        }

        // Récupération et nettoyage de l'email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if (!$email) {
            throw new Exception("Email invalide");
        }

        // Vérification si l'email existe
        $sql = "SELECT id, email FROM utilisateur WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Email trouvé, on stocke l'email en session
            $_SESSION['reset_email'] = $email;
            header("Location: resetpassword.php");
            exit();
        } else {
            $error_message = "Aucun compte n'est associé à cette adresse email.";
        }

    } catch (Exception $e) {
        $error_message = "Une erreur est survenue, veuillez réessayer.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRYF - Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="../css/ForgetPassword.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-section">
                <a href="firstpage.php">
                    <img src="../assets/images/logo.png" alt="CRYF Logo" class="logo">
                    <span class="brand-name">CRYF</span>
                </a>
            </div>
            <nav>
                <a href="signup.php" class="btn inscription">Inscription</a>
                <a href="signin.php" class="btn connexion">Se connecter</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Réinitialiser votre mot de passe</h2>
        <br>
        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
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
                        
            <button type="submit" class="btn">Envoyer les instructions de réinitialisation</button>

            <p class="login-link">Vous vous souvenez de votre mot de passe ? <a href="signin.php">Se connecter</a></p>
        </form>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <a href="firstpage.php">
                    <img src="../assets/images/logo.png" alt="CRYF Logo">
                </a>
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
                    <li><a href="offres.php">Offre de stage</a></li>
                    <li><a href="cgu.php">Conditions d'Utilisation</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
    
            <div class="footer-alertes">
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