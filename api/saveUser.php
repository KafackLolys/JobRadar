<?php
// File
require_once("./database.php");

$pdo = getConnexion();
tryTable();

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Hachage du mot de passe
    $email = $_POST['email'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $code = $_POST['code'];
    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $count = $stmt->fetchColumn();

if ($count > 0) {
    echo "<p class='msg_user_exist'>Un utilisateur avec cet email existe déjà !</p>";
    include("../Components/inscription.php");
} else {
    $sql = "INSERT INTO user (nom, prenom, sexe, password, email, pays, tel)
    VALUES (:nom, :prenom, :sexe, :mdp, :email, :pays, :telephone)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pays', $pays);
    $stmt->bindParam(':telephone', $telephone);

    if ($stmt->execute()) {
    echo "<h1 class='msg_reussite'>Compte créer avec succès.</h1>
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
    } else {
    echo "Erreur : " . $stmt->errorInfo()[2];
    }
}
?>
