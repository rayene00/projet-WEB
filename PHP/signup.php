<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion BDD distante
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
    $prenom = htmlspecialchars($_POST["prenom"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $telephone = !empty($_POST["telephone"]) ? htmlspecialchars($_POST["telephone"]) : null;
    $entreprise = !empty($_POST["entreprise"]) ? htmlspecialchars($_POST["entreprise"]) : null;
    $role_id = isset($_POST["role"]) ? intval($_POST["role"]) : null;
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $message = "Les mots de passe ne correspondent pas.";
    } else {
        $check_stmt = $conn->prepare("SELECT id FROM utilisateur WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $message = "Cet email est déjà utilisé.";
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $conn->prepare("INSERT INTO utilisateur (prenom, nom, email, mot_de_passe, role_id, telephone, entreprise) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssiss", $prenom, $nom, $email, $password_hash, $role_id, $telephone, $entreprise);

            if ($stmt->execute()) {
                $message = "Inscription réussie. Vous pouvez maintenant <a href='signin.php'>vous connecter</a>.";
            } else {
                $message = "Erreur SQL : " . $stmt->error;
            }
            $stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="/projet-WEB/css/signup.css">
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
            <a href="signin.php" class="btn connexion">Se connecter</a>
        </nav>
    </div>
</header>

<div class="container">
    <h2>Inscription</h2>
    <br>

    <?php if ($message): ?>
        <p class="form-message"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" action="signup.php">
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
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-group confirm-password-group">
                <label>Confirmer le mot de passe *</label>
                <input type="password" name="confirm_password" placeholder="Confirmation" required>
            </div>
        </div>

        <div class="form-group-terms-group-checkbox-group">
            <div>
                <input type="checkbox" id="terms" required>
                <label for="terms">J'accepte les conditions d'utilisateur</label>
            </div>
            <a href="cgu.html" class="terms-link">Lire les CGU</a>
        </div>

        <button type="submit" class="btn">S'inscrire</button>

        <p class="login-link">Déjà inscrit ? <a href="signin.php">Se connecter</a></p>
    </form>
</div>

<!-- Ajout du footer -->
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
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </div>
</footer>

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
