<?php

session_start();
// File
require_once("../../api/database.php");

$pdo = getConnexion();
//experiance
if (is_numeric($_GET["id_exp"])) {
    $stmt = $pdo->prepare("DELETE FROM experiance WHERE id = :id");
    $stmt->bindParam(':id', $_GET["id_exp"]);
    $exe = $stmt->execute();
    
        echo "<h1 class='msg_reussite'>Experiance supprimer avec succès.</h1>";
            echo "<style>
                .msg_reussite {
                    position: absolute;
                    width: 100%;
                    text-align: center;
                    top: 75px;
                    color: rgb(18, 41, 24);
                    font-family: Arial, sans-serif;
                }
                </style>";
            echo "<script>setTimeout(function() { window.location.href = '../../index.php'; }, 3000);</script>";
            header("refresh:3;url=../../index.php");
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
            echo "<script>setTimeout(function() { window.location.href = '../../index.php'; }, 4000);</script>";
            header("refresh:4;url=../../index.php");
        exit();
    }
?>