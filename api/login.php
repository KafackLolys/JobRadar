<?php
session_start();
// File
require_once("./database.php");

$pdo = getConnexion();
tryTable();
if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Préparation de la requête SQL pour récupérer l'utilisateur par email
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {

        if (password_verify($mdp, $user['password'])) {     
            // Authentification réussie
            unset($user['password']);//exclut le mot de passe
            $_SESSION['user_job'] = $user;
            echo "<h1 class='msg_reussite'>Heureus de vous revoir !</h1>
            <style>
                .msg_reussite{
                position: absolute;
                width: 100%;
                text-align: center;
                top: 75px;
                color: rgb(0, 129, 52);
                font-family: Arial, sans-serif;
            }
            </style>
            ";
            echo "<script>setTimeout(function() { window.location.href = '../index.php'; }, 6000);</script>";
        } else {
            echo "<p class='err_msg'>Mot de passe incorrect !</p>";
            include("../Components/connexion.php");
        }
    } else {
        // Email non trouvé
        echo "<p class='err_msg'>Cet email ne correspond à aucun compte !</p>";
            include("../Components/connexion.php");
    }
} else {
            echo "<h1 class=>Redirection vers le formulaire de connexion</h1>
            <style>
                .msg_reussite{
                position: absolute;
                width: 100%;
                text-align: center;
                top: 75px;
                color: rgb(0, 129, 52);
                font-family: Arial, sans-serif;
            }
            </style>
            ";
            echo "<script>setTimeout(function() { window.location.href = '../Components/connexion.php'; }, 6000);</script>";
    include("../Components/connexion.php");
}
?>
