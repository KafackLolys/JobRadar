<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

header('Content-Type: application/json');
// File
require_once("./database.php");

$pdo = getConnexion();
tryTable();

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$sexe = $_POST['sexe'];
$mdp = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT); // Hachage du mot de passe
$email = $_POST['email'];
$pays = $_POST['pays'];
$telephone = $_POST['telephone'];
$statut = $_POST['statut']; //statut soit chomeur ou employeur
// Vérifier si l'email existe déjà
$stmt_chomeur = $pdo->prepare("SELECT COUNT(*) FROM chomeur WHERE email = :email");
$stmt_chomeur->bindParam(':email', $email);
$stmt_chomeur->execute();
$count_chomeur = $stmt_chomeur->fetchColumn();

$stmt_employeur = $pdo->prepare("SELECT COUNT(*) FROM employeur WHERE email = :email");
$stmt_employeur->bindParam(':email', $email);
$stmt_employeur->execute();
$count_employeur = $stmt_employeur->fetchColumn();




$count = $count_chomeur + $count_employeur;
if ($count > 0) {
    echo json_encode(['success' => false, 'message' => 'Un utilisateur avec cet email existe déjà !']);
} else {


    $mail = new PHPMailer(true);

    try {
        // Générer un nombre aléatoire entre 1000 et 9999 (4 chiffres)
        $randomNumber = rand(1000, 9999);
        // Stocker le code généré dans une variable de session
        $_SESSION['confirmation_code'] = $randomNumber;

        // Paramètres du serveur
        $mail->isSMTP();                                           // Utiliser SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Serveur SMTP
        $mail->SMTPAuth   = true;                                  // Activer l'authentification SMTP
        $mail->Username   = 'jobradar50@gmail.com';              // Adresse email SMTP
        $mail->Password   = 'aees jfre rqom qeed';                       // Mot de passe SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Chiffrement TLS
        $mail->Port       = 587;                                   // Port TCP pour SMTP

        // Destinataire
        $mail->setFrom('jobradar50@gmail.com', 'JobRadar');
        $mail->addAddress($_POST['email'], $_POST['nom']); // Ajouter un destinataire

        // Contenu
        $mail->isHTML(true);                                       // Format de l'email en HTML
        $mail->Subject = 'Code de JobRadar';
        $mail->Body    = '<h2>Le code de confirmation est : ' . $randomNumber . '</h2>';

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Email envoyé avec succès']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi de l\'email : ' . $mail->ErrorInfo]);
    }
}
?>