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

// Récupération de l'ID entreprise depuis l'URL avec valeur par défaut
$entreprise_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Requête pour obtenir les informations de l'entreprise
$sqlEntreprise = "SELECT id, nom, description, email, telephone 
                  FROM entreprise 
                  WHERE id = ?";

$stmtEntreprise = $conn->prepare($sqlEntreprise);
$stmtEntreprise->bind_param("i", $entreprise_id);
$stmtEntreprise->execute();
$entreprise = $stmtEntreprise->get_result()->fetch_assoc();

// Vérification si l'entreprise existe
if (!$entreprise) {
    die("Entreprise non trouvée");
}

// Tableau associatif des logos
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

// Première requête : statistiques globales
$sqlStats = "SELECT 
    COUNT(*) as nombre_avis,
    ROUND(AVG(note_avis), 1) as moyenne_notes
    FROM avis 
    WHERE entreprise_id = ?";

$stmtStats = $conn->prepare($sqlStats);
$stmtStats->bind_param("i", $entreprise_id);
$stmtStats->execute();
$stats = $stmtStats->get_result()->fetch_assoc();

// Deuxième requête : détail des avis
$sqlAvis = "SELECT description_avis, note_avis, date_avis
    FROM avis 
    WHERE entreprise_id = ?
    ORDER BY date_avis DESC";

$stmtAvis = $conn->prepare($sqlAvis);
$stmtAvis->bind_param("i", $entreprise_id);
$stmtAvis->execute();
$resultAvis = $stmtAvis->get_result();

// Requête pour récupérer les offres de stage de l'entreprise
$sqlOffres = "SELECT id, titre, description, date_publication, duree_du_stage, 
              ville, code_postal, categorie, date_creation 
              FROM offre_de_stage 
              WHERE entreprise_id = ? 
              ORDER BY date_creation DESC";
$stmtOffres = $conn->prepare($sqlOffres);
$stmtOffres->bind_param("i", $entreprise_id);
$stmtOffres->execute();
$resultOffres = $stmtOffres->get_result();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CRYF - Entreprise</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/zoomentreprise.css">
  <script src="../JS/zoomentreprise.js" defer></script>
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
      <a href="signup.html" class="btn inscription">Inscription</a>
      <a href="signin.html" class="btn connexion">Se connecter</a>
    </nav>
  </div>
</header>

<section class="entreprise-section">
  <div class="entreprise-header">
    <div class="entreprise-info card">
      <div class="logo-nom">
        <img src="<?= $logos[$entreprise['nom']] ?? '../assets/images/default.png' ?>" 
             alt="Logo <?= htmlspecialchars($entreprise['nom']) ?>" 
             class="logo-entreprise-large">
        <h1><?php echo htmlspecialchars($entreprise['nom']); ?></h1>
      </div>
    </div>
    <div class="note card">
      <h3>Note moyenne de l'entreprise</h3>
      <div class="stars">
        <?php
        $moyenne = $stats['moyenne_notes'] ?? 0;
        $pleines = floor($moyenne);
        $demie = ($moyenne - $pleines) >= 0.5;
        for ($i = 0; $i < $pleines; $i++) echo '<i class="fas fa-star"></i>';
        if ($demie) echo '<i class="fas fa-star-half-alt"></i>';
        for ($i = $pleines + $demie; $i < 5; $i++) echo '<i class="far fa-star"></i>';
        ?>
      </div>
    </div>
  </div>

  <div class="entreprise-description">
    <h2>À propos de l'entreprise</h2>
    <p><?php echo $entreprise['description']; ?></p>
  </div>

  <div class="offres-section">
    <h2>Offres liées</h2>
    <?php while ($offre = $resultOffres->fetch_assoc()): ?>
        <div class="offre-card">
            <div class="offre-gauche">
                <img src="<?= $logos[$entreprise['nom']] ?? '../assets/images/default.png' ?>" 
                     alt="<?= htmlspecialchars($entreprise['nom']) ?>" 
                     class="offre-logo">
                <div>
                    <h3><?php echo htmlspecialchars($offre['titre']); ?></h3>
                    <p><?php echo htmlspecialchars($entreprise['nom']) . ' • ' . htmlspecialchars($offre['ville']); ?></p>
                    <div class="tags">
                        <span class="tag"><?php echo htmlspecialchars($offre['categorie']); ?></span>
                        <span class="tag"><?php echo htmlspecialchars($offre['duree_du_stage']) . ' mois'; ?></span>
                        <span class="tag"><?php echo htmlspecialchars($offre['ville']) . ' (' . htmlspecialchars($offre['code_postal']) . ')'; ?></span>
                        <span class="tag">Publié le <?php 
                            $date = new DateTime($offre['date_creation']);
                            echo $date->format('d/m/Y'); 
                        ?></span>
                    </div>
                    <p class="description"><?php echo htmlspecialchars($offre['description']); ?></p>
                </div>
            </div>
            <a href="postuler.php?offre_id=<?php echo $offre['id']; ?>" class="btn postuler">Postuler</a>
        </div>
    <?php endwhile; ?>
  </div>
</section>

<main>
  <section class="avis-section">
    <div class="avis-form-container">
        <h2>Avis d'étudiants</h2>
        <h3 class="avis-title">Donnez votre avis</h3>
        <form id="avisForm" method="POST" action="envoi_avis_utilisateur.php">
            <input type="hidden" name="entreprise_id" value="<?php echo $entreprise_id; ?>">
            <input type="hidden" name="note" id="noteInput" value="0">
            
            <div class="rating-container">
                <div class="stars" id="starsContainer">
                    <i class="far fa-star" data-value="1"></i>
                    <i class="far fa-star" data-value="2"></i>
                    <i class="far fa-star" data-value="3"></i>
                    <i class="far fa-star" data-value="4"></i>
                    <i class="far fa-star" data-value="5"></i>
                </div>
                <span class="rating-text">Note : <span id="noteText">0</span>/5</span>
            </div>

            <div class="avis-text-container">
                <textarea name="description_avis" id="avisText" 
                          maxlength="450" 
                          placeholder="Partagez votre expérience (450 caractères max)"></textarea>
                <div class="char-count">
                    <span id="charCount">0</span>/450
                </div>
            </div>

            <button type="submit" class="btn submit-avis">Envoyer l'avis</button>
        </form>
    </div>

    <div class="avis-liste">
        <?php while ($avis = $resultAvis->fetch_assoc()): ?>
            <div class="avis-card">
                <div class="rating">
                    <?php 
                    for ($i = 0; $i < 5; $i++) {
                        echo $i < $avis['note_avis'] ? 
                             '<i class="fas fa-star"></i>' : 
                             '<i class="far fa-star"></i>';
                    }
                    ?>
                </div>
                <p><?php echo htmlspecialchars($avis['description_avis']); ?></p>
                <span class="avis-date">
                    <?php 
                    $date = new DateTime($avis['date_avis']);
                    echo $date->format('d/m/Y'); 
                    ?>
                </span>
            </div>
        <?php endwhile; ?>
    </div>
  </section>
</main>

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