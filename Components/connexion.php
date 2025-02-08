<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../style/connexion.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
</head>

<body>
<?php
//header
include("header.php");
?>
<main>
    <form method="POST" action="../api/login.php">
            <h1>Connexion</h1>
            <input type="email" name="email" class="champ" id="email" placeholder="Email" required>
            <input type="password" name="mdp" class="champ" id="mdp" placeholder="Mot de passe" required>
            <button class="btn" type="submit">Valider</button>
            <br><br><br>
            <p>Je n'ai pas de compte  _ <a href="http://localhost/Projet_de_soutenance/Components/inscription.php">s'inscrire</a></p>
            <br>
            <p><a href="">Mot de passe oublié</a></p>
    </form>
</main>
</body>
</html>

<?php

?>