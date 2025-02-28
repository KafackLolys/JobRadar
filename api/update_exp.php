<?php

session_start();
require_once("./database.php");
$pdo = getConnexion();
tryTable();

$user = $_SESSION['user_job'];
$id_user = $user["id"];
$id_experiance = $_POST['id_exp'];
if (isset($id_user, $_POST['titre'], $_POST['description']) && is_numeric($id_experiance)) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    $sql = "UPDATE experiance SET titre=:titre, description=:description WHERE id_user=:id_user AND id = :id_exp";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_exp', $id_experiance);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {

        if (isset($_FILES['image'], $_POST['titre_i'], $_POST['description_i']) && !empty($_FILES['image']['name']) && !empty($_POST['titre_i']) && !empty($_POST['description_i'])) {
            // Recupération de l'image en bd
            $stmt = $pdo->prepare("SELECT id, type, element FROM piece_jointe WHERE id_experiance = :id_exp AND type = 'image'");
            $stmt->bindParam(':id_exp', $id_experiance);

            if ($stmt->execute()) {
                $piece_jointe_image = $stmt->fetch(PDO::FETCH_ASSOC);

                $image = $_FILES['image'];
                $titre_i = $_POST['titre_i'];
                $description_i = $_POST['description_i'];
                // Vérifiez les erreurs de téléchargement de fichier
                if ($image['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../public/experiances/';

                    $newName = $piece_jointe_image["element"];
                    $uploadFile = $uploadDir . $newName;

                    // Vérifiez que le répertoire de destination existe et est accessible
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // Copiez le fichier dans le répertoire de destination
                    if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                        // Préparer la requête SQL pour mettre à jour la table
                        $stmt = $pdo->prepare("UPDATE piece_jointe SET titre = :titre_i, description = :description_i WHERE id_experiance = :id_experiance AND type = 'image'");
                        $stmt->bindParam(':id_experiance', $id_experiance, PDO::PARAM_INT);
                        $stmt->bindParam(':titre_i', $titre_i);
                        $stmt->bindParam(':description_i', $description_i);
                        $stmt->execute();
                    }
                }
            } else {
                echo "<h1 class='msg_reussite'>Echec de modofication de l'image</h1>";
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
                echo "<script>setTimeout(function() { window.location.href = '../Components/Presentation/experiance.php?id_exp=$id_experiance'; }, 4000);</script>";
                header("refresh:4;url=../Components/Presentation/experiance.php?id_exp=$id_experiance");
                exit();
            }
        }
        if (isset($_FILES['document'], $_POST['titre_d'], $_POST['description_d']) && !empty($_FILES['document']['name']) && !empty($_POST['titre_d']) && !empty($_POST['description_d'])) {
            // Recupération du document en bd
            $stmt = $pdo->prepare("SELECT id, type, element FROM piece_jointe WHERE id_experiance = :id_exp AND type = 'document'");
            $stmt->bindParam(':id_exp', $id_experiance);

            if ($stmt->execute()) {
                $piece_jointe_document = $stmt->fetch(PDO::FETCH_ASSOC);
                $document = $_FILES['document'];

                $titre_d = $_POST['titre_d'];
                $description_d = $_POST['description_d'];
                // Vérifiez les erreurs de téléchargement de fichier
                if ($document['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/../public/documents/';
                    $originalName = basename($document['name']);
                    $fileInfo = pathinfo($originalName);
                    $extension = strtolower($fileInfo['extension']);

                    $nomDocument = $piece_jointe_document["element"];
                    //Recupération du nom du document sans l'extension
                    $point = strpos($nomDocument, '.');

                    if ($point !== false) { #si le point est trouver récupérer la chaine avant le point
                        $nom = substr($nomDocument, 0, $point);
                    } else {
                        $nom = $nomDocument;
                    }
                    $newName = $nom . '.' . $extension;
                    $uploadFile = $uploadDir . $newName;

                    // Vérifiez que le répertoire de destination existe et est accessible
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // Copiez le fichier dans le répertoire de destination
                    if (move_uploaded_file($document['tmp_name'], $uploadFile)) {
                        // Préparer la requête SQL pour mettre à jour la table
                        $stmt = $pdo->prepare("UPDATE piece_jointe SET titre = :titre_d, description = :description_d, element = :new_element WHERE id_experiance = :id_experiance AND type = 'document'");
                        $stmt->bindParam(':id_experiance', $id_experiance, PDO::PARAM_INT);
                        $stmt->bindParam(':titre_d', $titre_d);
                        $stmt->bindParam(':description_d', $description_d);
                        $stmt->bindParam(':new_element', $newName);
                        $stmt->execute();
                    }
                }
            }
        }
        echo "<h1 class='msg_reussite'>experiance Modifier avec succès.</h1>";
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
        echo "<script>setTimeout(function() { window.location.href = '../Components/Presentation/experiance.php?id_exp=$id_experiance'; }, 3000);</script>";
        header("refresh:3;url=../Components/Presentation/experiance.php?id_exp=$id_experiance");
        exit();
    } else {
        echo "<h1 class='msg_reussite'>Echec de modification du document</h1>";
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
        echo "<script>setTimeout(function() { window.location.href = '../Components/Presentation/experiance.php?id_exp=$id_experiance'; }, 4000);</script>";
        header("refresh:4;url=../Components/Presentation/experiance.php?id_exp=$id_experiance");
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
    echo "<script>setTimeout(function() { window.location.href = '../Components/Presentation/experiance.php?id_exp=$id_experiance'; }, 4000);</script>";
    header("refresh:4;url=../Components/Presentation/experiance.php?id_exp=$id_experiance");
    exit();
}
?>
