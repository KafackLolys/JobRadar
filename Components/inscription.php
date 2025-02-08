<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../style/inscription.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
</head>

<body>
<?php
//header
include("header.php");
?>

<main>

<form id="multiStepForm" method="POST" action="../api/saveUser.php">

    <div class="tab">
        <h2>Étape 1 : Informations Personnelles</h2>
        <br>
        <p class="label-message" id="nom-label"></p>
        <input required type="text" class="champ" placeholder="Nom" name="nom">
        <p class="error-message" id="nom-error"></p>
        <p class="label-message" id="prenom-label"></p>
        <input required type="text" class="champ" placeholder="Prénom" name="prenom">
        <p class="error-message" id="prenom-error"></p>
        <div class="sexe">
            <div>Sexe</div>
            <div><label for="Masculin">Masculin</label><input required type="radio" value="Masculin" name="sexe" id="Masculin"></div>
            <div><label for="Feminin">Feminin</label><input required type="radio" value="Feminin" name="sexe" id="Feminin"></div>
        </div>
        <p class="error-message" id="sexe-error"></p>
        <p class="label-message" id="mdp-label"></p>
        <input required type="password" class="champ" placeholder="Mot de passe" name="mdp" id="mdp">
        <p class="error-message" id="mdp-error"></p>
        <p class="label-message" id="cmdp-label"></p>
        <input required type="password" class="champ" placeholder="Confirmer votre mot de passe" name="cmdp" id="cmdp">     
        <p class="error-message" id="cmdp-error"></p>
         
    </div>
    <div class="tab">
        <h2>Étape 2 : Adresse</h2>
        <br>
        <p class="label-message" id="email-label"></p>
        <input required type="email" class="champ" placeholder="Email" name="email">
        <p class="error-message" id="email-error"></p>
        <p class="label-message" id="pays-label"></p>
        <input required type="text" class="champ" placeholder="Pays" name="pays">
        <p class="error-message" id="pays-error"></p>
        <p class="label-message" id="telephone-label"></p>
        <input required type="number" class="champ" placeholder="Telephone" name="telephone">
        <p class="error-message" id="telephone-error"></p>
    </div>
    <div class="tab">
        <h2>Étape 3 : Code de confirmation</h2>
        <br>
        <p class="label-message" id="code-label"></p>
        <input required type="number" class="champ" placeholder="Code" name="code" maxlength="4">
        <p class="error-message" id="code-error"></p>
    </div>
    <div class="button-container">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Précédent</button>
        <button type="button" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
    </div>
</form>
</main>

<script src="../script/inscription.js"></script>
</body>
</html>

<?php

?>