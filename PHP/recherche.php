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

// Initialisation des résultats
$stage_results = null;
$user_results = null;

// Récupération des paramètres de recherche
$keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
$location = isset($_GET['location']) ? trim($_GET['location']) : '';
$search_users = isset($_GET['search_users']) ? trim($_GET['search_users']) : '';

// Recherche de stages
if (!empty($keywords) || !empty($location)) {
    $sql = "SELECT os.*, e.nom as nom_entreprise 
            FROM offre_de_stage os
            LEFT JOIN entreprise e ON os.entreprise_id = e.id
            WHERE 1=1";
    $params = [];
    $types = "";

    if (!empty($keywords)) {
        $sql .= " AND (os.titre LIKE ? OR os.categorie LIKE ?)";
        $params[] = "%$keywords%";
        $params[] = "%$keywords%";
        $types .= "ss";
    }

    if (!empty($location)) {
        $sql .= " AND (os.ville LIKE ? OR os.code_postal LIKE ?)";
        $params[] = "%$location%";
        $params[] = "%$location%";
        $types .= "ss";
    }

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $stage_results = $stmt->get_result();
}

// Recherche d'utilisateurs
if (!empty($search_users)) {
    $sql = "SELECT prenom, nom, email, telephone, photo_profil 
            FROM utilisateur 
            WHERE nom LIKE ? OR prenom LIKE ?";
    
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search_users%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $user_results = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recherche - CRYF</title>
    <link rel="stylesheet" href="../CSS/recherche.css">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- HEADER directement intégré -->
<header>
    <div class="header-container">
        <div class="logo-section">
            <a href="firstpage.php">
                <img src="../assets/images/logo.png" alt="CRYF Logo" class="logo">
            </a>
            <span class="brand-name">CRYF</span>
        </div>
        <nav>
            <a href="#" class="access-recruteur">Accès Recruteur ></a>
            <a href="signup.php" class="btn inscription">Inscription</a>
            <a href="signin.php" class="btn connexion">Se connecter</a>
        </nav>
    </div>
</header>

<main class="container">
    <div class="search-sections">
        <!-- Recherche de stages -->
        <section class="stages-search">
            <h2>Rechercher un stage</h2>
            <form action="recherche.php" method="GET" class="search-bar">
                <input type="text" name="keywords" placeholder="Catégories, mots clés..." 
                       value="<?= htmlspecialchars($keywords) ?>">
                <input type="text" name="location" placeholder="Ville, code postal..." 
                       value="<?= htmlspecialchars($location) ?>">
                <button type="submit" class="btn rechercher">Rechercher un stage</button>
            </form>
        </section>

        <!-- Recherche d'utilisateurs -->
        <section class="users-search">
            <h2>Rechercher un utilisateur</h2>
            <form action="recherche.php" method="GET" class="search-bar">
                <input type="text" name="search_users" placeholder="Nom ou prénom..." 
                       value="<?= htmlspecialchars($search_users) ?>">
                <button type="submit" class="btn rechercher">Rechercher un utilisateur</button>
            </form>
        </section>
    </div>

    <!-- Résultats des stages -->
    <?php if ($stage_results !== null): ?>
        <section class="results-container stages-results">
            <h2>Résultats des stages</h2>
            <?php if ($stage_results->num_rows > 0): ?>
                <?php while($row = $stage_results->fetch_assoc()): ?>
                    <div class="stage-card">
                        <h3><?php echo htmlspecialchars($row['titre']); ?></h3>
                        <p class="entreprise"><?php echo htmlspecialchars($row['nom_entreprise'] ?? 'Entreprise inconnue'); ?></p>
                        <p class="location"><?php echo htmlspecialchars($row['ville']); ?> (<?php echo htmlspecialchars($row['code_postal']); ?>)</p>
                        <p class="categorie"><?php echo htmlspecialchars($row['categorie']); ?></p>
                        <p class="description"><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="duree">Durée : <?php echo htmlspecialchars($row['duree_du_stage']); ?> mois</p>
                        <a href="zoomoffre.php?id=<?php echo $row['id']; ?>" class="btn voir-plus">Voir plus</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>Aucun stage ne correspond à vos critères.</p>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <!-- Résultats des utilisateurs -->
    <?php if ($user_results !== null): ?>
        <section class="results-container users-results">
            <h2>Résultats des utilisateurs</h2>
            <?php if ($user_results->num_rows > 0): ?>
                <?php while($user = $user_results->fetch_assoc()): ?>
                    <div class="user-card">
                        <div class="user-avatar">
                            <img src="<?= !empty($user['photo_profil']) ? '../uploads/' . htmlspecialchars($user['photo_profil']) : '../assets/images/logoProfil.jpg' ?>" 
                                 alt="Photo de profil">
                        </div>
                        <div class="user-info">
                            <h3><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h3>
                            <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($user['email']) ?></p>
                            <?php if (!empty($user['telephone'])): ?>
                                <p><i class="fas fa-phone"></i> <?= htmlspecialchars($user['telephone']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>Aucun utilisateur trouvé.</p>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</main>

<!-- FOOTER directement intégré -->
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
                <li><a href="../HTML/quisommesnous.html">Qui sommes-nous ?</a></li>
                <li><a href="../HTML/avis.html">Avis</a></li>
                <li><a href="../HTML/mentions.html">Mentions légales</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Liens utiles</h3>
            <ul>
                <li><a href="../HTML/offres.html">Offre de stage</a></li>
                <li><a href="../HTML/cgu.html">Conditions d'Utilisations</a></li>
                <li><a href="../HTML/contact.html">Contact</a></li>
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
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
?>