<?php
function profile_entreprise($id_user,$profile, $nom_entreprise, $pdo){
// Vérifier les erreurs de téléchargement de fichier
if ($profile['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../public/entreprises/';
    
    // Récupérer le nom de fichier original et son extension
    $originalName = basename($profile['name']);
    $fileInfo = pathinfo($originalName);
    $extension = strtolower($fileInfo['extension']);
    
    // Construire le nouveau nom de fichier avec un point avant l'extension png
    // Vérifier si l'entreprise existe déjà
    $stmt = $pdo->prepare("SELECT id FROM entreprise WHERE id_user = :id_user AND nom= :nom");
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':nom', $nom_entreprise);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $entreprise = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $id_entreprise = $entreprise["id"];

    // Créer un nouveau nom de fichier unique en ajoutant un horodatage
    $timestamp = time();
    $newName = $id_user . $id_entreprise . $timestamp . '.png';
    
    $uploadFile = $uploadDir . $newName;

    // répertoire de destination existe et est accessible
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Copier le fichier vers le répertoire de destination
    if (move_uploaded_file($profile['tmp_name'], $uploadFile)) {
        // Préparer la requête SQL pour mettre à jour la table
        $stmt = $pdo->prepare("UPDATE entreprise 
                               SET profile = :profile
                               WHERE id = :id_entreprise");
        $stmt->bindParam(':picture', $newName);
        $stmt->bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            
            $errorInfo = $stmt->errorInfo();
            echo "<script>
                console.log('$errorInfo[2]');
            </script>";
            return false;
        }
    } else {
        return false;
    }
} else {
    return false;
}
}
?>