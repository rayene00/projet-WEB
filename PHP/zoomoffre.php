<?php
session_start();

// Connexion à la base de données
$servername = "98.66.232.225";
$username = "groupeweb";
$password = "mdpgroupe123";
$dbname = "cryf";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération et sécurisation de l'ID
$offre_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$offre_id) {
    header("Location: offres.php");
    exit();
}

// Requête préparée pour récupérer l'offre et les infos de l'entreprise
$sql = "SELECT o.*, e.nom as nom_entreprise, e.description as description_entreprise 
        FROM offre_de_stage o 
        LEFT JOIN entreprise e ON o.entreprise_id = e.id 
        WHERE o.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $offre_id);
$stmt->execute();
$result = $stmt->get_result();

// Vérification si l'offre existe
if ($result->num_rows === 0) {
    header("Location: offres.php");
    exit();
}

$offre = $result->fetch_assoc();

// Tableau des logos d'entreprises
$logos = [
    'Airbus' => '../assets/images/airbusavis.png',
    'Total' => '../assets/images/total.png',
    'Vinci' => '../assets/images/vinci.png',
    'Orange' => '../assets/images/orange.jpg',
    'Google' => '../assets/images/google.webp',
    'Microsoft' => '../assets/images/microsoft.png',
    'Apple' => '../assets/images/Apple_logo_black.png',
    'Amazon' => '../assets/images/amazon.jpg',
    'Facebook' => '../assets/images/facebook.png',
    'IBM' => '../assets/images/IBM_logo.svg.png',
    'Intel' => '../assets/images/Intel_logo_(2006-2020).svg.png',
    'Nvidia' => '../assets/images/nvidia.png',
    'Siemens' => '../assets/images/siemens.png',
    'Samsung' => '../assets/images/samsung.png',
    'CIC' => '../assets/images/CICavis.png',
    'Schneider' => '../assets/images/Schneideravis.jpg',
    'SFR' => '../assets/images/SFRavis.png',
    'Tesla' => '../assets/images/tesla.png'
];

$logo = isset($logos[$offre['nom_entreprise']]) ? $logos[$offre['nom_entreprise']] : '../assets/images/logoProfil.jpg';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($offre['titre']) ?> - CRYF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/firstpage.css">
    <link rel="stylesheet" href="../CSS/zoomoffre.css">
</head>
<body>

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
        </nav>
    </div>
</header>

<main class="offre-details">
    <div class="offre-header">
        <div class="entreprise-info">
            <img src="<?= $logo ?>" alt="Logo <?= htmlspecialchars($offre['nom_entreprise']) ?>" class="entreprise-logo">
            <div class="entreprise-details">
                <h1><?= htmlspecialchars($offre['titre']) ?></h1>
                <p class="entreprise-name">
                    <i class="fas fa-building"></i>
                    <?= htmlspecialchars($offre['nom_entreprise']) ?>
                </p>
            </div>
        </div>
        
        <div class="offre-meta">
            <div class="tags">
                <span class="tag">
                    <i class="fas fa-map-marker-alt"></i>
                    <?= htmlspecialchars($offre['ville']) ?> 
                    (<?= htmlspecialchars($offre['code_postal']) ?>)
                </span>
                <span class="tag">
                    <i class="fas fa-clock"></i>
                    <?= htmlspecialchars($offre['duree_du_stage']) ?> mois
                </span>
                <span class="tag">
                    <i class="fas fa-tag"></i>
                    <?= htmlspecialchars($offre['categorie']) ?>
                </span>
                <span class="tag">
                    <i class="fas fa-calendar"></i>
                    Publié le <?= date('d/m/Y', strtotime($offre['date_publication'])) ?>
                </span>
            </div>
        </div>
    </div>

    <div class="offre-content">
        <section class="description">
            <h2>Description du poste</h2>
            <div class="description-content">
                <?= nl2br(htmlspecialchars($offre['description'])) ?>
            </div>
        </section>

        <aside class="actions">
            <a href="postuler.php?offre_id=<?= $offre['id'] ?>" class="btn postuler">
                <i class="fas fa-paper-plane"></i> Postuler
            </a>
            <a href="zoomentreprise.php?id=<?= $offre['entreprise_id'] ?>" class="btn voir-entreprise">
                <i class="fas fa-building"></i> Voir l'entreprise
            </a>
        </aside>
    </div>
</main>

<!-- Footer -->
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
                <li><a href="offres.php">Offre de stage</a></li>
                <li><a href="cgu.php">Conditions d'Utilisations</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <!-- Section Alerte de stages -->
        <div class="footer-alertes">
            <h3>Alertes de stages</h3>
            <p>Les dernières offres de stages envoyées par mail chaque semaine.</p>
            <form action="newsletter.php" method="POST" class="newsletter">
                <input type="email" name="email" placeholder="exemple@xxx.com" required>
                <button type="submit" class="btn">Inscription</button>
            </form>
        </div>
    </div>

    <!-- Ligne de séparation -->
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

<?php
$stmt->close();
$conn->close();
?>