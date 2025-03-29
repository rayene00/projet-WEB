<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

// Vérifier si l'ID de l'offre est présent
if (!isset($_GET['offre_id'])) {
    header('Location: offres.php');
    exit();
}

$offre_id = $_GET['offre_id'];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "98.66.232.225";
    $username = "groupeweb";
    $password = "mdpgroupe123";
    $dbname = "cryf";

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            throw new Exception("Connexion échouée : " . $conn->connect_error);
        }

        // Traitement des fichiers uploadés
        $cv_name = $_FILES['cv']['name'];
        $lettre_name = $_FILES['lettre_motivation']['name'];
        
        $cv_path = "../uploads/cv/" . uniqid() . "_" . $cv_name;
        $lettre_path = "../uploads/lettres/" . uniqid() . "_" . $lettre_name;

        move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path);
        move_uploaded_file($_FILES['lettre_motivation']['tmp_name'], $lettre_path);

        // Insertion dans la base de données
        $sql = "INSERT INTO candidature (date_candidature, cv, lettre_motivation, offre_id, utilisateur_id) 
                VALUES (NOW(), ?, ?, ?, ?)";
                
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $cv_path, $lettre_path, $offre_id, $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            header("Location: zoomoffre.php?id=" . $offre_id . "&success=1");
            exit();
        } else {
            $error = "Erreur lors de l'envoi de la candidature";
        }

    } catch (Exception $e) {
        $error = "Une erreur est survenue : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postuler - CRYF</title>
    <link rel="stylesheet" href="../css/postuler.css">
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
                <a href="profil.php" class="btn inscription">Mon Profil</a>
                <a href="logout.php" class="btn connexion">Déconnexion</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <h1>Postuler à l'offre</h1>
        
        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="candidature-form">
            <div class="form-group">
                <label for="cv">CV (PDF uniquement)</label>
                <input type="file" name="cv" id="cv" accept=".pdf" required>
            </div>

            <div class="form-group">
                <label for="lettre_motivation">Lettre de motivation (PDF uniquement)</label>
                <input type="file" name="lettre_motivation" id="lettre_motivation" accept=".pdf" required>
            </div>

            <button type="submit" class="btn submit">Envoyer ma candidature</button>
        </form>
    </main>

    <footer>
        <!-- Même footer que les autres pages -->
    </footer>
</body>
</html>