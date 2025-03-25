<?php
session_start();
require_once("./database.php");
$user_info = $_SESSION["user_info"];
$email = $user_info['email'];
$pdo = getConnexion();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code de Vérification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .verification-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 1.5rem;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 1.5rem;
            text-align: center;
            border: none;
            border-radius: 4px;
            background-color: #333;
            color: #ffd700;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Une code de vérification a été envoyé à <b><?php echo $email; ?></b></h1>
    <form class="verification-container" method="POST" action="verification_code.php">
        <label for="verification-code">Entrez votre code de vérification :</label>
        <input type="number" id="verification-code" name="code" min="1000" max="9999" required placeholder="XXXX" maxlength="4">
        <input type="submit" value="Vérifier" name="verifier">
    </form>
</body>

</html>
<?php

if (isset($_POST["verifier"])) {

    if ($_POST["code"] == $_SESSION['confirmation_code']) {
        $user_info = $_SESSION["user_info"];
        $nom = $user_info['nom'];
        $prenom = $user_info['prenom'];
        $sexe = $user_info['sexe'];
        $mdp = $user_info['motdepasse']; // mot de passe déjà haché
        $email = $user_info['email'];
        $pays = $user_info['pays'];
        $telephone = $user_info['telephone'];
        $statut = $user_info['statut']; //statut soit chomeur ou employeur
        $sql = "INSERT INTO $statut (nom, prenom, sexe, password, email, pays, tel)
        VALUES (:nom, :prenom, :sexe, :mdp, :email, :pays, :telephone)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pays', $pays);
        $stmt->bindParam(':telephone', $telephone);

        if ($stmt->execute()) {
            echo "<h1 class='msg_reussite'>Compte créer avec succès.</h1>
        <style>
            .msg_reussite{
            position: absolute;
            width: 100%;
            text-align: center;
            top: 75px;
            color: rgb(0, 129, 52);
            font-family: Arial, sans-serif;
        }
            .msg_erreur{
            display: none;
        }
        </style>
        ";
            echo "<script>setTimeout(function() { window.location.href = '../Components/connexion.php'; }, 3000);</script>";
        } else {
            echo "Erreur : " . $stmt->errorInfo()[2];
        }
    }
    else {
        echo "<h1 class='msg_erreur'>Code de vérification incorrect.</h1>
        <style>
            .msg_erreur{
            color: rgb(129, 0, 0);
        }
        </style>
        "; 
    }
}
?>