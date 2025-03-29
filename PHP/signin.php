<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données distante
$servername = "98.66.232.225";
$username = "groupeweb";
$password = "mdpgroupe123";
$dbname = "cryf";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $message = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $conn->prepare("SELECT id, prenom, nom, email, role_id, mot_de_passe FROM utilisateur WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($db_user_id, $db_prenom, $db_nom, $db_email, $db_role_id, $db_password_hash);
            $stmt->fetch();

            if (password_verify($password, $db_password_hash)) {
                $_SESSION["user_id"] = $db_user_id;
                $_SESSION["prenom"] = $db_prenom;
                $_SESSION["nom"] = $db_nom;
                $_SESSION["email"] = $db_email;
                $_SESSION["role_id"] = $db_role_id;

                header("Location: apresconnexion.php");
                exit();
            } else {
                $message = "Mot de passe incorrect.";
            }
        } else {
            $message = "Adresse email ou mot de passe incorrect.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/projet-WEB/css/signin.css">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="header-container">
        <div class="logo-section">
            <a href="firstpage.html">
                <img src="../assets/images/logo.png" alt="CRYF Logo" class="logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>
        <nav>
            <a href="signup.php" class="btn inscription">Inscription</a>
            <a href="signin.php" class="btn connexion active">Se connecter</a>
        </nav>
    </div>
</header>

<div class="container">
    <h2>Connexion</h2>

    <?php if (!empty($message)): ?>
        <p class="form-message"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" action="signin.php">
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" name="email" placeholder="Votre email" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" placeholder="Votre mot de passe" required>
        </div>

        <a href="ForgetPassword.php" class="forgot-password">Mot de passe oublié ?</a>

        <button type="submit" class="btn submit">Se connecter</button>
    </form>

    <p class="register-link">Pas encore de compte ? <a href="signup.php">S'inscrire ici</a></p>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <a href="firstpage.html">
                <img src="../assets/images/logo.png" alt="CRYF Logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>
        <div class="footer-section">
            <h3>A propos</h3>
            <ul>
                <li><a href="#">Qui sommes-nous ?</a></li>
                <li><a href="#">Avis</a></li>
                <li><a href="#">Mentions légales</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Liens utiles</h3>
            <ul>
                <li><a href="#">Offres de stage</a></li>
                <li><a href="#">Conditions d'utilisation</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="footer-alertes">
            <h3>Alertes de stages</h3>
            <p>Les dernières offres envoyées chaque semaine.</p>
            <div class="newsletter">
                <input type="email" placeholder="exemple@xxx.com">
                <button class="btn">Inscription</button>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>2025 © CRYF. Tous droits réservés.</p>
        <div class="social-icons">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </div>
</footer>

</body>
</html>
