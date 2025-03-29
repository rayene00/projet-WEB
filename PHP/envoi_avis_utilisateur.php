<?php
session_start();

// Connexion à la base de données
$servername = "98.66.232.225";
$username = "groupeweb";
$password = "mdpgroupe123";
$dbname = "cryf";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connexion échouée : " . $conn->connect_error);
    }

    // Récupération et validation des données
    $entreprise_id = filter_input(INPUT_POST, 'entreprise_id', FILTER_VALIDATE_INT);
    $note = filter_input(INPUT_POST, 'note', FILTER_VALIDATE_INT);
    $description = trim($_POST['description_avis']);

    // Vérifications
    if (!$entreprise_id || !$note || $note < 1 || $note > 5) {
        throw new Exception("Données invalides");
    }

    if (strlen($description) > 450) {
        throw new Exception("Description trop longue");
    }

    // Insertion dans la base de données
    $sql = "INSERT INTO avis (description_avis, note_avis, entreprise_id, date_avis) 
            VALUES (?, ?, ?, NOW())";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $description, $note, $entreprise_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Erreur lors de l'insertion");
    }

    // Redirection avec succès
    header("Location: zoomentreprise.php?id=" . $entreprise_id . "&success=1");
    exit();

} catch (Exception $e) {
    // Redirection avec erreur
    header("Location: zoomentreprise.php?id=" . $entreprise_id . "&error=1");
    exit();
}