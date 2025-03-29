<?php
// Pas besoin de traitement PHP ici pour l'instant
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRYF - Trouver un Stage</title>
    <link rel="stylesheet" href="../css/firstpage.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="header-container">
            <div class="logo-section">
                <a href="firstpage.php">
                    <img src="../assets/images/logo.png" alt="CRYF Logo" class="logo">
                </a>
                <span class="brand-name">CRYF</span>
            </div>
            <nav>
                <a href="recruteur.php" class="access-recruteur">Accès Recruteur ></a>
                <a href="signup.php" class="btn inscription">Inscription</a>
                <a href="signin.php" class="btn connexion">Se connecter</a>
            </nav>
        </div>
    </header>
    
    <!-- SECTION HERO -->
    <section class="hero">
    <h1>Trouver le <span class="highlight">stage</span> de vos rêves, en toute simplicité</h1>
    
    <div class="search-container">
    <form action="recherche.php" method="GET" class="search-bar">
        <input type="text" name="keywords" placeholder="Catégories, mots clés..." value="<?php echo isset($_GET['keywords']) ? htmlspecialchars($_GET['keywords']) : ''; ?>">
        <input type="text" name="location" placeholder="Ville, code postal..." value="<?php echo isset($_GET['location']) ? htmlspecialchars($_GET['location']) : ''; ?>">
        <button type="submit" class="rechercher">Rechercher</button>
    </form>
</div>

<div class="search-container">
    <form action="recherche.php" method="GET" class="search-bar-student">
        <button type="submit" class="rechercher">Rechercher un Pilote/Etudiant</button>
    </form>
</div>

    </section>

    <!-- PARTENAIRES -->
    <section class="partenaires">
        <p>Entreprises avec lesquelles nous travaillons :</p>
        <div class="logos">
            <a href="https://www.airbus.com" target="_blank">
                <img src="../assets/images/airbus.png" alt="Airbus">
            </a>
            <a href="https://www.vinci.com" target="_blank">
                <img src="../assets/images/vinci.png" alt="Vinci">
            </a>
            <a href="https://www.orange.fr" target="_blank">
                <img src="../assets/images/orange.png" alt="Orange">
            </a>
            <a href="https://totalenergies.com" target="_blank">
                <img src="../assets/images/total.png" alt="TotalEnergies">
            </a>
        </div>
    </section>

    <!-- FOOTER -->
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
                <form action="newsletter.php" method="POST" class="newsletter">
                    <input type="email" name="email" placeholder="exemple@xxx.com" required>
                    <button type="submit" class="btn">Inscription</button>
                </form>
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