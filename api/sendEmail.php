<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

header('Content-Type: application/json');

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
?>