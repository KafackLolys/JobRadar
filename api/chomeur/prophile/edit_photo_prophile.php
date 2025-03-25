<?php
session_start();
require_once("../database.php");
$pdo = getConnexion();
tryTable();

$user = $_SESSION['user_job'];
$id_user = $user["id"];
if (isset($id_user, $_FILES['prophile'])) {
    $prophile = $_FILES['prophile'];

    // Vérifiez les erreurs de téléchargement de fichier
    if ($prophile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../public/users/';
        $originalName = basename($prophile['name']);
        $fileInfo = pathinfo($originalName);
        $extension = strtolower($fileInfo['extension']);


        // Vérifiez si l'utilisateur possède une photo de prophile et récupérer le nom
        $stmt = $pdo->prepare("SELECT prophile FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($entreprise['prophile'] == '') {
            // Créez un nouveau nom de fichier unique en ajoutant un horodatage
            $timestamp = time();
            $newName = $id_user .  $timestamp . '.png';
            $uploadFile = $uploadDir . $newName;
        } else {
            $newName = $entreprise['prophile'];
            $uploadFile = $uploadDir . $newName;
        }

        // Vérifiez que le répertoire de destination existe et est accessible
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Copiez le fichier dans le répertoire de destination
        if (move_uploaded_file($prophile['tmp_name'], $uploadFile)) {
            // Mettre à jour la base de données avec le nouveau nom de fichier
            $stmt = $pdo->prepare("UPDATE user SET prophile = :prophile WHERE id = :id");
            $stmt->bindParam(':prophile', $newName);
            $stmt->bindParam(':id', $id_user);
            if ($stmt->execute()) {
                $stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
                $stmt->bindParam(':id', $id_user);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_job'] = $user;
                echo "<script>setTimeout(function() { window.location.href = '../../Components/Prophile/prophile.php'; }, 50);</script>";
                header("refresh:0.05;url=../../Components/Prophile/prophile");
                exit();
            }
        }
    } else {
        echo "<h1 class='msg_reussite'>Echec de modification, réessayez plus tard.</h1>";
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
        echo "<script>setTimeout(function() { window.location.href = '../../Components/Prophile/prophile'; }, 3000);</script>";
        header("refresh:3;url=../../Components/Prophile/prophile");
        exit();
    }
} else {
    echo "<h1 class='msg_reussite'>Echec de modification, réessayez plus tard.</h1>";
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
    echo "<script>setTimeout(function() { window.location.href = '../../Components/Prophile/prophile'; }, 3000);</script>";
    header("refresh:3;url=../../Components/Prophile/prophile");
    exit();
}
