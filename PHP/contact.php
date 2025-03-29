<?php
// contact.php

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $message = htmlspecialchars($_POST['message']);

    try {
        // Connexion à la base de données distante
        $servername = "98.66.232.225";
        $username = "groupeweb";
        $password = "mdpgroupe123";
        $dbname = "cryf";

        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insertion des données dans la table `contact`
        $stmt = $pdo->prepare("INSERT INTO contact (prenom, nom, email, telephone, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$prenom, $nom, $email, $telephone, $message]);

        $success = true;
    } catch (PDOException $e) {
        $error = "Erreur de connexion : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../CSS/contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@600&family=Epilogue:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <div class="hero-wrapper">
        <div class="hero-background"></div>

        <header>
            <div class="header-container">
                <div class="logo-section">
                    <a href="firstpage.php">
                        <img src="../assets/images/logo.png" alt="CRYF Logo" class="logo">
                    </a>
                    <span class="brand-name">CRYF</span>
                </div>
                <nav>
                    <a href="recruteur.php" class="recruteur-link">Accès Recruteur</a>
                    <a href="signup.php" class="btn inscription">Inscription</a>
                    <a href="signin.php" class="btn connexion">Se connecter</a>
                </nav>
            </div>
        </header>

        <section class="hero">
            <h1><span class="highlight">Contacter</span> nous</h1>
        </section>
    </div>

    <!-- ✅ PARTIE 2 : Contact + Formulaire -->
    <section class="contact-section">
        <div class="contact-left">
            <p>
                Pour toute question ou information supplémentaire,<br>
                veuillez remplir le formulaire ci-dessous.<br><br>
                Nous vous répondrons dans les plus brefs délais.<br><br>
                Vous pouvez directement nous contacter au :<br>
                <span class="phone-number">04 56 78 90 12</span>
            </p>
        </div>

        <div class="contact-right">
            <?php if (!empty($success)) echo '<p class="success-msg">Votre message a été envoyé avec succès !</p>'; ?>
            <?php if (!empty($error)) echo '<p class="error-msg">' . $error . '</p>'; ?>

            <form method="POST" action="contact.php">
                <div class="form-row">
                    <input type="text" name="prenom" placeholder="Prénom" required>
                    <input type="text" name="nom" placeholder="Nom" required>
                </div>
                <div class="form-row">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="tel" name="telephone" placeholder="Téléphone" required>
                </div>
                <div class="form-row full">
                    <textarea name="message" placeholder="Messages" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Envoyer</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
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
                    <li><a href="cgu.php">Conditions d'Utilisations</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-alertes">
                <h3>Alertes de stages</h3>
                <p>Les dernières offres de stages envoyées par mail chaque semaine.</p>
                <div class="newsletter">
                    <form action="newsletter.php" method="POST">
                        <input type="email" name="email" placeholder="exemple@xxx.com" required>
                        <button type="submit" class="btn">Inscription</button>
                    </form>
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