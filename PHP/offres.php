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

// Récupération des filtres depuis l'URL
$categories = isset($_GET['categories']) ? $_GET['categories'] : [];
$durees = isset($_GET['duree']) ? $_GET['duree'] : [];

// Récupération des comptes de catégories
$category_counts = [];
$count_sql = "SELECT categorie, COUNT(*) as count FROM offre_de_stage GROUP BY categorie";
$count_result = $conn->query($count_sql);

while ($row = $count_result->fetch_assoc()) {
    $category_counts[$row['categorie']] = $row['count'];
}

// Construction de la requête SQL
$sql = "SELECT o.*, e.nom as nom_entreprise 
        FROM offre_de_stage o 
        LEFT JOIN entreprise e ON o.entreprise_id = e.id 
        WHERE 1=1";

$types = "";
$params = [];

// Catégories
if (!empty($categories)) {
    $placeholders = str_repeat('?,', count($categories) - 1) . '?';
    $sql .= " AND o.categorie IN ($placeholders)";
    $types .= str_repeat('s', count($categories));
    $params = array_merge($params, $categories);
}

// Durée
if (!empty($durees)) {
    $dureeConditions = [];
    foreach ($durees as $duree) {
        switch ($duree) {
            case '1-3':
                $dureeConditions[] = "(o.duree_du_stage BETWEEN 1 AND 3)";
                break;
            case '3-6':
                $dureeConditions[] = "(o.duree_du_stage BETWEEN 3 AND 6)";
                break;
            case '6+':
                $dureeConditions[] = "(o.duree_du_stage >= 6)";
                break;
        }
    }
    if (!empty($dureeConditions)) {
        $sql .= " AND (" . implode(' OR ', $dureeConditions) . ")";
    }
}

// Exécution
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offres de Stage - CRYF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/firstpage.css">
    <link rel="stylesheet" href="../css/offres.css">
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

<section class="hero">
    <h1>Trouvez votre <span class="highlight">stage</span> idéal</h1>
    <div class="search-bar">
        <input type="text" placeholder="Poste, mots clés...">
        <input type="text" placeholder="Ville, code postale...">
        <button class="btn rechercher">Rechercher</button>
    </div>
</section>

<main class="offres-wrapper">
    <div class="offres-container">
        <!-- FILTRES -->
        <aside class="filtres">
            <form method="GET" action="offres.php" id="filtres-form">
                <!-- Catégories -->
                <div class="filtre-bloc">
                    <div class="filtre-header"><span>Catégories</span></div>
                    <?php
                    $categoriesList = [
                        "Design", "Ventes", "Marketing", "Business",
                        "Ressources humaines", "Finance", "Ingénierie",
                        "Technologie", "Energie", "Communication"
                    ];
                    foreach ($categoriesList as $cat) {
                        $checked = in_array($cat, $categories) ? 'checked' : '';
                        $count = isset($category_counts[$cat]) ? $category_counts[$cat] : 0;
                        echo "<label class='checkbox-wrapper'>
                                <input type='checkbox' name='categories[]' value='$cat' $checked>
                                <span>$cat ($count)</span>
                              </label>";
                    }
                    ?>
                </div>

                <!-- Durée -->
                <div class="filtre-bloc">
                    <div class="filtre-header"><span>Durée du stage</span></div>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="duree[]" value="1-3" <?= in_array('1-3', $durees) ? 'checked' : '' ?>>
                        <span>1 à 3 mois</span>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="duree[]" value="3-6" <?= in_array('3-6', $durees) ? 'checked' : '' ?>>
                        <span>3 à 6 mois</span>
                    </label>
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="duree[]" value="6+" <?= in_array('6+', $durees) ? 'checked' : '' ?>>
                        <span>6 mois ou plus</span>
                    </label>
                </div>

                <button type="submit" class="btn filter-submit">Appliquer les filtres</button>
            </form>
        </aside>

        <!-- OFFRES -->
        <section class="liste-offres">
            <?php
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

            if ($result->num_rows > 0):
                while ($offre = $result->fetch_assoc()):
                    $logo = isset($logos[$offre['nom_entreprise']]) ? $logos[$offre['nom_entreprise']] : '../assets/images/logoProfil.jpg';
            ?>
                <div class="offre">
                    <div class="offre-logo">
                        <img src="<?= $logo ?>" alt="Logo <?= htmlspecialchars($offre['nom_entreprise']) ?>" class="entreprise-logo">
                    </div>
                    <div class="offre-details">
                        <h2><?= htmlspecialchars($offre['titre']) ?></h2>
                        <p><?= htmlspecialchars($offre['nom_entreprise']) ?> - <?= htmlspecialchars($offre['ville']) ?></p>
                        <div class="tags">
                            <span class="tag"><?= htmlspecialchars($offre['categorie']) ?></span>
                            <span class="tag"><?= htmlspecialchars($offre['duree_du_stage']) ?> mois</span>
                        </div>
                    </div>
                    <a href="zoomoffre.php?id=<?= $offre['id'] ?>" class="btn postuler">Voir plus</a>
                </div>
            <?php endwhile; else: ?>
                <p>Aucune offre trouvée.</p>
            <?php endif; ?>
        </section>
    </div>
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

<script>
document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        document.getElementById('filtres-form').submit();
    });
});
</script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>