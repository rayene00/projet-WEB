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
    $prenom = htmlspecialchars($_POST["prenom"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $telephone = !empty($_POST["telephone"]) ? htmlspecialchars($_POST["telephone"]) : NULL;
    $role = isset($_POST["role"]) ? htmlspecialchars($_POST["role"]) : NULL;
    $entreprise = ($role === "Pilote" && isset($_POST["entreprise"])) ? htmlspecialchars($_POST["entreprise"]) : NULL;
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirm_password) {
        echo "Erreur : Les mots de passe ne correspondent pas.";
        exit();
    }

    // Vérifier si l'email existe déjà
    $check_stmt = $conn->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<script>alert('Cet email est déjà utilisé.'); window.location.href = '../HTML/signup.html';</script>";
        exit();
    }
    $check_stmt->close();

    // Hasher le mot de passe
    $password_hash = password_hash($password, PASSWORD_BCRYPT); // Hachage sécurisé

    // Insérer l'utilisateur dans la base de données
    $stmt = $conn->prepare("INSERT INTO utilisateurs (prenom, nom, email, telephone, role, entreprise, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $prenom, $nom, $email, $telephone, $role, $entreprise, $password_hash);

    if ($stmt->execute()) {
        echo "<script>alert('Inscription réussie. Vous pouvez maintenant vous connecter.'); window.location.href = '../HTML/signin.html';</script>";
    } else {
        echo "<script>alert('Erreur lors de l\'inscription.'); window.location.href = '../HTML/signup.html';</script>";
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>
