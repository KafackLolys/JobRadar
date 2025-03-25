<?php

session_start();
if (!$_SESSION['user_id']) {
    header("Location: ../../../../index.php");
    exit();
}
// File
require_once("../../database.php");

$pdo = getConnexion();
//experiance
if (is_numeric($_GET["id_ent"])) {
    $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id = :id");
    $stmt->bindParam(':id', $_GET["id_ent"]);
    $exe = $stmt->execute();
    
    echo "<div class='msg_reussite'>
    <h1 class='msg_reussite'>Entreprise Supprimé avec succès.</h1>
    <img src='../../../public/ZhiXkcAB5J.gif' width='200px'>
    </div>";
    echo "<style>
                .msg_reussite {
                    width: 100%;
                    heigth: 100vh;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    }
            h1 {
                color: rgb(0, 129, 52);
                font-family: Arial, sans-serif;
            }
        </style>";
            echo "<script>setTimeout(function() { window.location.href = '../../../Components/employeur/index.php'; }, 3000);</script>";
            header("refresh:3;url=../../../Components/employeur/index.php");
        exit();
    }
    else{
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
            echo "<script>setTimeout(function() { window.location.href = '../../../Components/employeur/index.php'; }, 4000);</script>";
            header("refresh:4;url=../../../Components/employeur/index.php");
        exit();
    }
?>