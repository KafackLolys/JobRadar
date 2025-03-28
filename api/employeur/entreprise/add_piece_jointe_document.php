<?php

session_start();
require_once("../../database.php");
$pdo = getConnexion();
tryTable();

$id_user = $_SESSION['user_id'];

$id_entreprise = $_POST['id_ent'];
if (isset($id_user, $_POST['titre_d'], $_POST['description_d'], $_FILES['document']) && is_numeric($id_entreprise)) {
    
    $titre = $_POST['titre_d'];
    $description = $_POST['description_d'];
    $type = 'document'; // Définir le type comme 'document'
    $document = $_FILES['document'];

    // Vérifiez les erreurs de téléchargement de fichier
    if ($document['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../../public/entreprises/piece_jointe/documents/';
        $originalName = basename($document['name']);
        $fileInfo = pathinfo($originalName);
        $extension = strtolower($fileInfo['extension']);

        // Créez un nouveau nom de fichier unique en ajoutant un horodatage
        $timestamp = time();
        $newName = $id_user . $id_entreprise . $timestamp . '.' . $extension;
        $uploadFile = $uploadDir . $newName;

        // Vérifiez que le répertoire de destination existe et est accessible
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Copiez le fichier dans le répertoire de destination
        if (move_uploaded_file($document['tmp_name'], $uploadFile)) {
            // Mettre à jour la base de données avec le nouveau nom de fichier
            $stmt = $pdo->prepare("INSERT INTO piece_jointe(id_entreprise, titre, description, type, element) VALUES(:id_ent, :titre, :des, :type, :element)");
            $stmt->bindParam(':id_ent', $id_entreprise);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':des', $description);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':element', $newName);
            $stmt->execute();

            echo "<script>setTimeout(function() { window.location.href = '../../../Components/employeur/Presentation/entreprise.php?id_ent=$id_entreprise'; }, 50);</script>";
            header("refresh:0.05;url=../../../Components/employeur/Presentation/entreprise.php?id_ent=$id_entreprise");
            exit();
        }
    } else {
        echo "<h1 class='msg_reussite'>Echec de publication, réessayez plus tard.</h1>";
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
        echo "<script>setTimeout(function() { window.location.href = '../../../Components/employeur/Presentation/entreprise.php?id_ent=$id_entreprise'; }, 3000);</script>";
        header("refresh:3;url=../../../Components/employeur/Presentation/entreprise.php?id_ent=$id_entreprise");
        exit();
    }
} else {
    echo "<h1 class='msg_reussite'>Echec de publication, réessayez plus tard.</h1>";
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
    echo "<script>setTimeout(function() { window.location.href = '../../../Components/employeur/Presentation/entreprise.php?id_ent=$id_entreprise'; }, 3000);</script>";
    header("refresh:3;url=../../../Components/employeur/Presentation/entreprise.php?id_ent=$id_entreprise");
    exit();
}
?>
