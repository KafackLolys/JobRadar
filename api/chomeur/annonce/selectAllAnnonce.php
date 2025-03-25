<?php
require_once("../database.php");

function getAnnonces() {
    $pdo = getConnexion();
    $stmt = $pdo->query("SELECT * FROM annonce");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

header('Content-Type: application/json');
echo json_encode(getAnnonces());
?>