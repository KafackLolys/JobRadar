<?php

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style></style>
    <link rel="stylesheet" href="../../style/employeur/entreprise.css">
    <link rel="stylesheet" href="../../style/employeur/header.css">
    <link rel="stylesheet" href="../../style/employeur/footer.css">
    <title>Créer une entreprise</title>
</head>

<body>
    <?php
    //header
    include("header.php");
    ?>
    <main>
        <div class="frm_ent">
            <form action="../../api/employeur/saveEntreprise.php" method="post" enctype="multipart/form-data">
                <div class="champ">
                    <label for="prophile">Prophile (facultatif)</label>
                    <input type="file" name="prophile" accept="image/*" onchange="previewImage();" id="prophile">
                    <img id="imagePreview" src="#" alt="Prévisualisation de l'image" style="display: none; max-width: 200px;">
                </div>
                <div class="champ">
                    <label for="nom">Nom de l'entreprise</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="champ">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder='Description' required></textarea>
                </div>
                <div>
                    <button type="submit">Enregistrer l'entreprise</button>
                </div>
            </form>
            <div class="img"></div>
        </div>
    </main>
    <?php
    //footer 
    include("footer.html");
    ?>
    <script src="../../script/employeur/ajout_entreprise.js"></script>
</body>

</html>