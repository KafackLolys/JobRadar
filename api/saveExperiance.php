<?php
session_start();
if (!$_SESSION['user_job']) {
    header("Location: ../index.php");
    exit();
}
require_once("./database.php");
$pdo = getConnexion();
tryTable();

$user = $_SESSION['user_job'];
$id_user = $user["id"];

if (isset($id_user, $_POST['titre'], $_POST['description'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    // Vérifiez si l'experiance existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM experiance WHERE id_user = :id_user AND titre = :titre");
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':titre', $titre);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "<h1 class='msg_reussite'>Un département porte déja ce nom !</h1>";
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
        echo "<script>setTimeout(function() { window.location.href = '../Components/ajout_experiance.php'; }, 6000);</script>";
        header("refresh:6;url=../Components/ajout_experiance.php");
        exit();
    } else {
        $sql = "INSERT INTO experiance (id_user, titre, description) VALUES (:id_user, :titre, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            // Recupérqtion de l'id de l'experiance
            $stmt = $pdo->prepare("SELECT id FROM experiance WHERE id_user = :id_user AND titre = :titre");
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':titre', $titre);
            $stmt->execute();
            $experiance = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_experiance = $experiance['id'];


            if (isset($_FILES['image'], $_POST['titre_i'], $_POST['description_i'])) {
                $image = $_FILES['image'];
                $titre_i = $_POST['titre_i'];
                $description_i = $_POST['description_i'];
                // Vérifiez les erreurs de téléchargement de fichier
                if ($image['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../public/experiances/';
                    $originalName = basename($image['name']);
                    $fileInfo = pathinfo($originalName);
                    $extension = strtolower($fileInfo['extension']);

                    // Créez un nouveau titre de fichier unique en ajoutant un horodatage
                    $timestamp = time();
                    $newName = $id_user . $id_experiance . $timestamp . '.png';
                    $uploadFile = $uploadDir . $newName;

                    // Vérifiez que le répertoire de destination existe et est accessible
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // Copiez le fichier dans le répertoire de destination
                    if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                        $type = 'image';
                        // Préparer la requête SQL pour mettre à jour la table
                        $stmt = $pdo->prepare("INSERT INTO piece_jointe (id_experiance, titre, description, type, element) VALUES(:id_experiance, :titre_i, :description_i, :type, :element)");
                        $stmt->bindParam(':id_experiance', $id_experiance, PDO::PARAM_INT);
                        $stmt->bindParam(':titre_i', $titre_i);
                        $stmt->bindParam(':description_i', $description_i);
                        $stmt->bindParam(':type', $type);
                        $stmt->bindParam(':element', $newName);
                        $stmt->execute();
                    }
                }
            }
            if (isset($_FILES['document'], $_POST['titre_d'], $_POST['description_d'])) {
                $document = $_FILES['document'];
                $titre_d = $_POST['titre_d'];
                $description_d = $_POST['description_d'];
                // Vérifiez les erreurs de téléchargement de fichier
                if ($document['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../public/documents/';
                    $originalName = basename($document['name']);
                    $fileInfo = pathinfo($originalName);
                    $extension = strtolower($fileInfo['extension']);

                    // Créez un nouveau titre de fichier unique en ajoutant un horodatage
                    $timestamp = time();
                    $newName = $id_user . $id_experiance . $timestamp . '.' . $extension;
                    $uploadFile = $uploadDir . $newName;

                    // Vérifiez que le répertoire de destination existe et est accessible
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // Copiez le fichier dans le répertoire de destination
                    if (move_uploaded_file($document['tmp_name'], $uploadFile)) {
                        $type = 'document';
                        // Préparer la requête SQL pour mettre à jour la table
                        $stmt = $pdo->prepare("INSERT INTO piece_jointe (id_experiance, titre, description, type, element) VALUES(:id_experiance, :titre_d, :description_d, :type, :element)");
                        $stmt->bindParam(':id_experiance', $id_experiance, PDO::PARAM_INT);
                        $stmt->bindParam(':titre_d', $titre_d);
                        $stmt->bindParam(':description_d', $description_d);
                        $stmt->bindParam(':type', $type);
                        $stmt->bindParam(':element', $newName);
                        $stmt->execute();
                    }
                }
            }
            echo "<h1 class='msg_reussite'>experiance enregistrée avec succès.</h1>";
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
            echo "<script>setTimeout(function() { window.location.href = '../index.php'; }, 3000);</script>";
            header("refresh:3;url=../index.php");
            exit();
        }
    }
} else {
    echo "<h1 class='msg_reussite'>Paramètres incomplets ou absents -> Redirection vers le formulaire de l'experiance.</h1>";
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
    echo "<script>setTimeout(function() { window.location.href = '../Components/ajout_experiance.php'; }, 6000);</script>";
    header("refresh:6;url=../Components/ajout_experiance.php");
    exit();
}
