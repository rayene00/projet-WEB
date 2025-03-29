<?php
// Connexion à la base de données
$servername = "98.66.232.225";
$username = "groupeweb";
$password = "mdpgroupe123";
$dbname = "cryf";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Logos des entreprises
$logos = [
    'Airbus' => '../assets/images/airbusavis.png',
    'Total' => '../assets/images/total.png',
    'Vinci' => '../assets/images/vinci.png',
    'Orange' => '../assets/images/orange.jpg',
    'Google' => '../assets/images/google.webp',
    'Microsoft' => '../assets/images/microsoft.png',
    'Apple' => '../assets/images/Apple_logo_black.png',
    'Amazon' => '../assets/images/amazon.jpg',
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

// Récupération du terme recherché
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Requête SQL avec moyenne des notes
$sql = "SELECT e.id, e.nom, 
        COUNT(a.id) AS nombre_avis,
        ROUND(AVG(a.note_avis), 1) AS moyenne_notes
        FROM entreprise e
        LEFT JOIN avis a ON e.id = a.entreprise_id";

if (!empty($search)) {
    $sql .= " WHERE e.nom LIKE ? GROUP BY e.id, e.nom ORDER BY e.nom ASC";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param("s", $searchTerm);
} else {
    $sql .= " GROUP BY e.id, e.nom ORDER BY COUNT(a.id) DESC LIMIT 6";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
$entreprises = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>CRYF - Recherchez une entreprise</title>
    <link rel="stylesheet" href="../css/avis.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <a href="profil.php" class="btn profil">Mon profil</a>
        </nav>
    </div>
</header>

<section class="hero">
    <h1>Trouvez les entreprises qui vous ressemblent !</h1>
    <form method="GET" action="avis.php" class="search-bar">
        <input type="text" name="search" placeholder="Nom de l'entreprise..." value="<?= htmlspecialchars($search) ?>" />
        <button type="submit" class="btn rechercher">Rechercher</button>
    </form>
</section>

<main class="entreprises-container">
    <h2><?= !empty($search) ? 'Résultats de la recherche' : 'Entreprises les plus recherchées' ?></h2>

    <?php if (empty($entreprises)): ?>
        <div class="no-results">
            <p>Aucune entreprise trouvée pour "<?= htmlspecialchars($search) ?>"</p>
        </div>
    <?php else: ?>
        <div class="cards-container">
            <?php foreach ($entreprises as $e): ?>
                <div class="card">
                    <img src="<?= $logos[$e['nom']] ?? '../assets/images/default.png' ?>" alt="Logo <?= htmlspecialchars($e['nom']) ?>" />
                    <div class="card-info">
                        <h3><?= htmlspecialchars($e['nom']) ?></h3>
                        <div class="rating">
                            <span class="stars">
                                <?php
                                $note = floatval($e['moyenne_notes']);
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $note) {
                                        echo '<i class="fas fa-star"></i>';
                                    } elseif ($i - 0.5 <= $note) {
                                        echo '<i class="fas fa-star-half-alt"></i>';
                                    } else {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                }
                                ?>
                            </span>
                            <span class="reviews">(<?= $e['nombre_avis'] ?> avis)</span>
                        </div>
                    </div>
                    <a href="zoomentreprise.php?id=<?= urlencode($e['id']) ?>" class="btn avis-btn">Voir les avis</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

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
                <li><a href="offres.php">Offres de stage</a></li>
                <li><a href="cgu.php">Conditions d'utilisation</a></li>
                <li><a href="contact.php">Contact</a></li>
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

</body>
</html>