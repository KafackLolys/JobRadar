<?php
session_start();

// Stocker les erreur dans error.log
ini_set('log_error', 1);
ini_set('error_log', '../../error.log');
error_reporting(E_ALL);

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../index.php");
    exit();
}

require_once("../../database.php");
$pdo = getConnexion();
tryTable();


// Vérifiez si les données sont reçues
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données
    $id_entreprise = $_POST['id_entreprise'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $imageName = null;

    // Traitement de l'image si elle est fournie
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $timestamp = time();
        $imageName = $id_entreprise . $timestamp . '.png'; // Construct the image name
        $imageTmp = $_FILES['image']['tmp_name'];
        $uploadDir = '../../../public/annonces/';

        // Vérifiez que le répertoire de destination existe et est accessible
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Définir le chemin complet pour l'upload
        $uploadFile = $uploadDir . $imageName;

        // Copiez le fichier dans le répertoire de destination
        if (!move_uploaded_file($imageTmp, $uploadFile)) {
            // Erreur lors du déplacement du fichier
            echo json_encode(['success' => false, 'message' => 'Erreur lors du téléchargement de l\'image.']);
            exit;
        }
    }

    // Insérez les données dans la base de données
    $stmt = $pdo->prepare("INSERT INTO annonce (id_entreprise, titre, description, image, likes) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_entreprise, $titre, $description, $imageName, 0]);

    // Réponse JSON
    echo json_encode(['success' => true, 'message' => 'Annonce publiée avec succès!']);
    exit; // Terminer l'exécution après l'envoi de la réponse
}

// Réponse en cas d'erreur
echo json_encode(['success' => false, 'message' => 'Erreur lors de la soumission.']);
?>