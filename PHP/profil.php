<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

// Connexion à la base de données
$servername = "98.66.232.225";
$username = "groupeweb";
$password = "mdpgroupe123";
$dbname = "cryf";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération des informations de l'utilisateur
$stmt = $conn->prepare("SELECT nom, prenom, email, telephone, entreprise, photo_profil FROM utilisateur WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Traitement du téléversement de la photo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo_profil'])) {
    $target_dir = "../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_extension = strtolower(pathinfo($_FILES["photo_profil"]["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;
    
    $allowed_types = ['jpg', 'jpeg', 'png'];
    if (in_array($file_extension, $allowed_types) && move_uploaded_file($_FILES["photo_profil"]["tmp_name"], $target_file)) {
        // Mise à jour de la base de données
        $update_stmt = $conn->prepare("UPDATE utilisateur SET photo_profil = ? WHERE id = ?");
        $update_stmt->bind_param("si", $new_filename, $_SESSION['user_id']);
        $update_stmt->execute();
        $update_stmt->close();
        
        // Mettre à jour la variable user
        $user['photo_profil'] = $new_filename;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mon Profil - CRYF</title>
  <link rel="stylesheet" href="../css/profil.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
              <a href="firstpage.php" class="btn acceuil">Accueil</a>
              <a href="contact.php" class="btn contact">Contact</a>
          </nav>
      </div>
  </header>

  <!-- PROFIL -->
  <main class="main">
    <aside class="sidebar">
      <div class="sidebar-title"><i class="fa-solid fa-user"></i> PROFIL</div>
      <div class="sidebar-menu">
        <a href="#" class="menu-item active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
        <a href="#" class="menu-item"><i class="fa-solid fa-inbox"></i> Inbox</a>
        <a href="#" class="menu-item"><i class="fa-solid fa-book"></i> Lesson</a>
        <a href="#" class="menu-item"><i class="fa-solid fa-tasks"></i> Task</a>
        <a href="#" class="menu-item"><i class="fa-solid fa-users"></i> Group</a>
      </div>

      <div class="sidebar-section">
        <h4>FRIENDS</h4>
        <div class="friend"><img src="../assets/images/logoProfil.jpg" /> Prashant</div>
        <div class="friend"><img src="../assets/images/logoProfil.jpg" /> Prashant</div>
        <div class="friend"><img src="../assets/images/logoProfil.jpg" /> Prashant</div>
      </div>

      <div class="sidebar-section">
        <h4>SETTINGS</h4>
        <a href="#" class="menu-item"><i class="fa-solid fa-gear"></i> Paramètres</a>
        <a href="logout.php" class="menu-item logout"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
      </div>
    </aside>

    <section class="profile">
      <div class="profile-card">
        <form method="POST" enctype="multipart/form-data" class="photo-form">
            <div class="avatar-container">
                <img src="<?= !empty($user['photo_profil']) ? '../uploads/' . htmlspecialchars($user['photo_profil']) : '../assets/images/logoProfil.jpg' ?>" 
                     class="avatar" alt="Photo de profil">
                <div class="photo-upload">
                    <input type="file" name="photo_profil" id="photo_profil" accept="image/jpeg,image/png">
                    <button type="submit" class="btn update-photo">Mettre à jour la photo</button>
                </div>
            </div>
        </form>
        
        <div class="profile-info">
            <h2><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h2>
            <p><i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($user['email']) ?></p>
            <p><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($user['telephone']) ?></p>
            <?php if (!empty($user['entreprise'])): ?>
                <p><i class="fa-solid fa-building"></i> <?= htmlspecialchars($user['entreprise']) ?></p>
            <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

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
                <li><a href="../HTML/quisommesnous.html">Qui sommes-nous ?</a></li>
                <li><a href="#">Avis</a></li>                    
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