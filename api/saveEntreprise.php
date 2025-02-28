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

if (isset($id_user, $_POST['nom'], $_POST['description'], $_FILES['prophile'])) {//verifier si les champs sont renseigner
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prophile = $_FILES['prophile'];

    // Vérifiez si l'entreprise existe déjà
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM entreprise WHERE id_user = :id_user AND nom = :nom");
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "<p class='msg_en_exist'>Une de vos entreprises porte déjà ce nom !</p>";
        include("../Components/ajout_entreprise.php");
    } else {
        $sql = "INSERT INTO entreprise (id_user, nom, description) VALUES (:id_user, :nom, :description)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            // Vérifiez les erreurs de téléchargement de fichier
            if ($prophile['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../public/entreprises/';
                $originalName = basename($prophile['name']);
                $fileInfo = pathinfo($originalName);
                $extension = strtolower($fileInfo['extension']);
                
                // Vérifiez si l'entreprise existe déjà pour obtenir son identifiant
                $stmt = $pdo->prepare("SELECT id FROM entreprise WHERE id_user = :id_user AND nom = :nom");
                $stmt->bindParam(':id_user', $id_user);
                $stmt->bindParam(':nom', $nom);
                $stmt->execute();
                $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_entreprise = $entreprise['id'];

                // Créez un nouveau nom de fichier unique en ajoutant un horodatage
                $timestamp = time();
                $newName = $id_user . $id_entreprise . $timestamp . '.png';
                $uploadFile = $uploadDir . $newName;

                // Vérifiez que le répertoire de destination existe et est accessible
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Copiez le fichier dans le répertoire de destination
                if (move_uploaded_file($prophile['tmp_name'], $uploadFile)) {
                    // Préparer la requête SQL pour mettre à jour la table
                    $stmt = $pdo->prepare("UPDATE entreprise SET prophile = :prophile WHERE id = :id_entreprise");
                    $stmt->bindParam(':prophile', $newName);
                    $stmt->bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
                    if ($stmt->execute()) {
                        echo "<h1 class='msg_reussite'>Entreprise enregistrée avec succès.</h1>";
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
                        echo "<script>setTimeout(function() { window.location.href = '../index.php'; }, 6000);</script>";
                        header("refresh:6;url=../index.php");
                        exit();
                    }
                }
            }
        }
    }
} else {
    echo "<h1 class='msg_reussite'>Paramètres incomplets ou absents -> Redirection vers le formulaire de l'entreprise.</h1>";
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
    echo "<script>setTimeout(function() { window.location.href = '../Components/ajout_entreprise.php'; }, 6000);</script>";
    header("refresh:6;url=../Components/ajout_entreprise.php");
    exit();
}
?>
