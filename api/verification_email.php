<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once("./database.php");

header('Content-Type: application/json');
session_start();

$pdo = getConnexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $mdp = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT); // Hachage du mot de passe
    $email = $_POST['email'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $statut = $_POST['statut']; // statut soit chomeur ou employeur

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

    // Vérification si l'email existe déjà
    if ($count > 0) {
        echo json_encode(['success' => false, 'message' => "L'email existe déjà."]);
    } else {
        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['user_info'] = [
            'nom' => $nom,
            'prenom' => $prenom,
            'sexe' => $sexe,
            'motdepasse' => $mdp,
            'email' => $email,
            'pays' => $pays,
            'telephone' => $telephone,
            'statut' => $statut
        ];

        $mail = new PHPMailer(true);
        try {
            // Générer un nombre aléatoire entre 1000 et 9999 (4 chiffres)
            $randomNumber = rand(1000, 9999);
            $_SESSION['confirmation_code'] = $randomNumber;

            // Paramètres du serveur
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jobradar50@gmail.com';
            $mail->Password   = 'aees jfre rqom qeed'; // Assurez-vous de ne pas exposer le mot de passe
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Destinataire
            $mail->setFrom('jobradar50@gmail.com', 'JobRadar');
            $mail->addAddress($email, $nom);

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = 'Code de JobRadar';
            $mail->Body    = '<h2>Le code de confirmation est : ' . $randomNumber . '</h2>';

            $mail->send();
            echo json_encode(['success' => true, 'message' => 'Email envoyé avec succès']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi de l\'email : ' . $mail->ErrorInfo]);
        }
    }
}