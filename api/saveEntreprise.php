<?php
session_start();
// File
require_once("./database.php");

$pdo = getConnexion();
tryTable();

$user = $_SESSION['user_job'];
$id_user = $user["id"];
if (isset($id_user) && isset($_POST['nom']) && isset($_POST['description']) && isset($_FILES['profile'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    $profile = $_FILES['profile'];

    // Vérifier si l'entreprise existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM entreprise WHERE id_user = :id_user AND nom= :nom");
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "<p class='msg_user_exist'>Une de vos entreprises possède déjà ce nom !</p>";
        include("../Components/ajout_entreprise.php");
    } else {
        $sql = "INSERT INTO entreprise (id_user, nom, description)
    VALUES (:id_user, :nom, :description, :profile)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            //Ajout de la photo de profile en cas de succès avec pour nom l'id de l'entreprise suivie de .png 
        echo "<h1 class='msg_reussite'>Entreprise enregistrer avec succès.</h1>
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
            echo "Erreur : " . $stmt->errorInfo()[2];
        }
    }
} else {
    echo "<h1 class='msg_reussite'>Paramètres incomplets ou absent ->  Redirection vers le formulaire de l'entreprise.</h1>
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
    echo "<script>setTimeout(function() { window.location.href = '../Components/ajout_entreprise.php'; }, 6000);</script>";
}
