<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userCode = $_POST['code'];
    $generatedCode = $_SESSION['confirmation_code'] ?? null;

    if ($userCode == $generatedCode) {
        echo json_encode(['success' => true, 'message' => 'Code validé avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Code de confirmation incorrect']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode de requête non supportée']);
}
?>
