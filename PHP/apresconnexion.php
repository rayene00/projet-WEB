<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}
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
                <a href="profil.php" class="btn inscription">Mon Profil</a>
                <a href="logout.php" class="btn connexion">Déconnexion</a>
            </nav>
        </div>
    </header>
    
    <!-- SECTION HERO -->
    <section class="hero">
        <h1>Trouver le <span class="highlight">stage</span> de vos rêves, en toute simplicité</h1>
        <form action="offres.php" method="GET" class="search-bar">
            <input type="text" name="keyword" placeholder="Poste, mots clés...">
            <input type="text" name="location" placeholder="Ville, code postal...">
            <button type="submit" class="btn rechercher">Rechercher</button>
        </form>
    </section>

    <!-- PARTENAIRES -->
    <section class="partenaires">
        <p>Entreprises avec lesquelles nous travaillons :</p>
        <div class="logos">
            <?php
            $logos = [
                'Airbus' => '../assets/images/airbus.png',
                'Total' => '../assets/images/total.png',
                'Vinci' => '../assets/images/vinci.png',
                'Orange' => '../assets/images/orange.png',
            ];

            foreach ($logos as $nom => $logo) {
                echo '<a href="#" class="partenaire-logo">';
                echo '<img src="' . htmlspecialchars($logo) . '" alt="Logo ' . htmlspecialchars($nom) . '">';
                echo '</a>';
            }
            ?>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <!-- Logo et nom -->
            <div class="footer-logo">
                <a href="firstpage.php">
                    <img src="../assets/images/logo.png" alt="CRYF Logo">
                </a>
                <span class="brand-name">CRYF</span>
            </div>
    
            <!-- Section A propos -->
            <div class="footer-section">
                <h3>A propos</h3>
                <ul>
                    <li><a href="quisommesnous.php">Qui sommes-nous ?</a></li>
                    <li><a href="avis.php">Avis</a></li>                    
                    <li><a href="mentions.php">Mentions légales</a></li>                   
                </ul>
            </div>
    
            <!-- Section Liens utiles -->
            <div class="footer-section">
                <h3>Liens utiles</h3>
                <ul>
                    <li><a href="offres.php">Offres de stage</a></li>
                    <li><a href="cgu.php">Conditions d'Utilisation</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
    
            <!-- Section Alerte de stages -->
            <div class="footer-alertes">
                <h3>Alertes de stages</h3>
                <p>Les dernières offres de stages envoyées par mail chaque semaine.</p>
                <form method="POST" action="newsletter.php" class="newsletter">
                    <input type="email" name="email" placeholder="exemple@xxx.com" required>
                    <button type="submit" class="btn">Inscription</button>
                </form>
            </div>
        </div>
    
        <!-- Ligne de séparation -->
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