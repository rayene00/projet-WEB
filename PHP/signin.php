<?php
session_start(); // Démarrer la session

// Activer l'affichage des erreurs (à désactiver en production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cryf_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];

    // Vérifier si l'email et le mot de passe sont fournis
    if (empty($email) || empty($password)) {
        echo "<script>alert('Erreur : Veuillez remplir tous les champs.'); window.history.back();</script>";
        exit();
    }

    // Préparer la requête pour vérifier si l'utilisateur existe
    $stmt = $conn->prepare("SELECT id, prenom, nom, email, role, password FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Vérifier si l'utilisateur existe
    if ($stmt->num_rows === 1) { // Vérification correcte
        $stmt->bind_result($db_user_id, $db_prenom, $db_nom, $db_email, $db_role, $db_password_hash);
        $stmt->fetch();

        // Vérifier si le mot de passe est correct
        if (password_verify($password, $db_password_hash)) {
            // Sauvegarder les infos dans la session
            $_SESSION["user_id"] = $db_user_id;
            $_SESSION["prenom"] = $db_prenom;
            $_SESSION["nom"] = $db_nom;
            $_SESSION["email"] = $db_email;
            $_SESSION["role"] = $db_role;

            // Rediriger vers la page de profil
            header("Location: ../HTML/aprèsco.html");
            exit();
        } else {
            // Mot de passe incorrect
            echo "<script>alert('Erreur : Mot de passe incorrect.'); window.history.back();</script>";
            exit();
        }
    } else {
        // Si l'utilisateur n'existe pas
        echo "<script>alert('Erreur : Adresse email ou mot de passe incorrect.'); window.history.back();</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Erreur : Requête invalide.'); window.history.back();</script>";
    exit();
}
?>
