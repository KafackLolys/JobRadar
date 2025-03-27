<?php
// Stocker les erreur dans error.log
ini_set('log_error', 1);
ini_set('error_log', '../../error.log');
error_reporting(E_ALL);
require_once("../../database.php");
// Vérifiez si les données sont reçues
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_entreprise = $_POST['id_entreprise'];
    function getAnnonces($id_entreprise)
    {
        $pdo = getConnexion();
        $stmt = $pdo->prepare("SELECT * FROM annonce WHERE id_entreprise = :id_entreprise ORDER BY id DESC");
        $stmt->bindParam(':id_entreprise', $id_entreprise);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    header('Content-Type: application/json');
    echo json_encode(getAnnonces($id_entreprise));
    exit; // Terminer l'exécution après l'envoi de la réponse
}

// Réponse en cas d'erreur
echo json_encode(['success' => false, 'message' => 'Erreur lors de la soumission.']);
?>