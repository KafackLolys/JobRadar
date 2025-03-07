<?php

session_start();
require_once("../database.php");
$pdo = getConnexion();
tryTable();

$user = $_SESSION['user_job'];
$id_user = $user["id"];
$id_entreprise = $_POST['id_ent'];
if (isset($id_user, $_POST['nom'], $_POST['description']) && is_numeric($id_entreprise)) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    $sql = "UPDATE entreprise SET nom=:nom, description=:description WHERE id_user=:id_user AND id = :id_ent";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_ent', $id_entreprise);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        echo "<h1 class='msg_reussite'>Entreprise Modifier avec succès.</h1>";
        echo "<style>
                .msg_reussite {
                    position: absolute;
                    width: 100%;
                    text-align: center;
                    top: 75px;
                    color: rgb(0, 129, 52);
                    font-family: Arial, sans-serif;
                }
                </style>";
        echo "<script>setTimeout(function() { window.location.href = '../../Components/Presentation/entreprise.php?id_ent=$id_entreprise'; }, 3000);</script>";
        header("refresh:3;url=../../Components/Presentation/entreprise.php?id_ent=$id_entreprise");
        exit();
    }
} else {
    echo "<h1 class='msg_reussite'>Echec de modofication.</h1>";
    echo "<style>
        .msg_reussite {
            position: absolute;
            width: 100%;
            text-align: center;
            top: 75px;
            color: rgb(200, 54, 10);
            font-family: Arial, sans-serif;
        }
        </style>";
    echo "<script>setTimeout(function() { window.location.href = '../../Components/Presentation/entreprise.php?id_ent=$id_entreprise'; }, 3000);</script>";
    header("refresh:3;url=../../Components/Presentation/entreprise.php?id_ent=$id_entreprise");
    exit();
}
?>