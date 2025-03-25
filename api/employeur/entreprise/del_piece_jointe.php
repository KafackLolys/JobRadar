<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../../../index.php");
    exit();
}
// File
require_once("../../database.php");

$pdo = getConnexion();
//experiance
if (is_numeric($_GET["id_pj"])) {
    $stmt = $pdo->prepare("SELECT * FROM piece_jointe WHERE id = :id");
    $stmt->bindParam(':id', $_GET["id_pj"]);
    $stmt->execute();
    $fichier = $stmt->fetch(PDO::FETCH_ASSOC);
    //Suppression du fichier
    $chemin_fichier = "../../../public/entreprises/piece_jointe/$fichier[type]s/$fichier[element]";

    if (file_exists($chemin_fichier)) {
        if (is_writable($chemin_fichier)) {
            if (unlink($chemin_fichier)) {
                echo "<script>
                        console.log('le fichier $chemin_fichier est supprimer');
                      </script>";
            } else {
                echo "<script>
                        console.log('Erreur : Impossible de supprimer le fichier $chemin_fichier. Vérifiez les permissions.');
                      </script>";
            }
        } else {
            echo "<script>
                        console.log('Erreur : Le fichier $chemin_fichier nest pas accessible en écriture. Vérifiez les permissions.');
                   </script>";
        }
    } else {
        echo "<script>
                        console.log('Erreur : Le fichier $chemin_fichier nexiste pas.');
            </script>";
    }
    $stmt = $pdo->prepare("DELETE FROM piece_jointe WHERE id = :id");
                $stmt->bindParam(':id', $_GET["id_pj"]);
                $exe = $stmt->execute();
    header("location: ../../../Components/employeur/Presentation/entreprise.php?id_ent=$_GET[id_ent]");
    exit();
} else {
    echo "<h1 class='msg_echec'>Echec de suppréssion.</h1>";
    echo "<style>
                .msg_echec {
                    position: absolute;
                    width: 100%;
                    text-align: center;
                    top: 75px;
                    color: rgb(87, 40, 40);
                    font-family: Arial, sans-serif;
                }
                </style>";
    echo "<script>setTimeout(function() { window.location.href = '../../../Components/employeur/Presentation/entreprise.php?id_ent=$_GET[id_ent]'; }, 4000);</script>";
    header("refresh:4;url=../../../Components/employeur/Presentation/entreprise.php?id_ent=$_GET[id_ent]");
    exit();
}
