<?php
session_start();
require_once("./database.php");

$pdo = getConnexion();
tryTable();

if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Préparation de la requête SQL pour récupérer l'utilisateur par email
    $stmt = $pdo->prepare("
    SELECT 'chomeur' AS type, id, email, password FROM chomeur WHERE email = :email
    UNION
    SELECT 'employeur' AS type, id, email, password FROM employeur WHERE email = :email
    ");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérification du mot de passe
        if (password_verify($mdp, $user['password'])) {
            // Authentification réussie
            unset($user['password']); // Exclut le mot de passe
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['type'];

            echo "<h1 class='msg_reussite'>Heureux de vous revoir !</h1>
            <style>
                .msg_reussite {
                    position: absolute;
                    width: 100%;
                    text-align: center;
                    top: 75px;
                    color: rgb(0, 129, 52);
                    font-family: Arial, sans-serif;
                }
            </style>
            ";
            echo "<script>setTimeout(function() { window.location.href = '../Components/$user[type]/index.php'; }, 5000);</script>";
        } else {
            echo "<p class='err_msg'>Mot de passe incorrect !</p>";
            include("../Components/connexion.php");
        }
    } else {
        // Email non trouvé dans les deux tables
        echo "<p class='err_msg'>Cet email ne correspond à aucun compte !</p>";
        include("../Components/connexion.php");
    }
} else {
    echo "<h1 class='err_msg'>Redirection vers le formulaire de connexion</h1>
    <style>
        .err_msg {
            position: absolute;
            width: 100%;
            text-align: center;
            top: 75px;
            color: rgb(129, 0, 0);
            font-family: Arial, sans-serif;
        }
    </style>
    ";
    echo "<script>setTimeout(function() { window.location.href = '../Components/connexion.php'; }, 6000);</script>";
    include("../Components/connexion.php");
}
