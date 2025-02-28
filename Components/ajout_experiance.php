<?php
if (!$_SESSION['user_job']) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style></style>
    <link rel="stylesheet" href="../style/experiance.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <title>Créer une entreprise</title>
</head>

<body>
    <?php
    //header
    include("header.php");
    ?>
    <main>
        <form class="all"  action="../api/saveexperiance.php" method="POST" enctype="multipart/form-data">
            <div style="background-color: #333; color: white; padding: 10px">
                <h1>Ajouter une experiance</h1>
            </div>
            <div class="frm_ent">
                <div class="p1">
                    <div class="champ">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" required>
                    </div>
                    <div class="champ">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" placeholder='Description' required></textarea>
                    </div>
                </div>
                <fieldset class="p2">
                    <legend>Pièce jointe (facultatif)</legend>
                    <div class="champ">
                        <label for="image">Image</label>
                        <div style="display: flex;">
                            <input type="file" name="image" accept="image/*" onchange="previewImage();" id="image">
                            <img id="imagePreview" src="#" alt="Prévisualisation de l'image" style="display: none; max-width: 100px; max-height: 100px;">
                        </div>
                        <div id="champ_i" style="display: none;">
                            <input type="text" name="titre_i" placeholder="Titre de l'image">
                            <textarea name="description_i" id="description_i" placeholder="Description  de l'image"></textarea>
                        </div>
                    </div>
                    <div class="champ">
                        <label for="document">Document (Taille maximale de 2 Mo)</label>
                        <div style="display: flex;">
                            <input type="file" name="document" accept=".doc, .docx, .pdf, .txt, .rtf, .html, .odt, .xml, .csv, .json, .md" onchange="previewFile()" id="doc">
                            <div id="image_svg"></div>
                        </div>
                        <div id="champ_d" style="display: none;">
                            <input type="text" name="titre_d" placeholder="Titre du document">
                            <textarea name="description_d" id="description_d" placeholder="Description du document"></textarea>
                        </div>
                    </div>

                </fieldset>
            </div>
            <div>
                <button type="submit">Enregistrer l'experiance</button>
            </div>
        </form>
    </main>
    <?php
    //footer 
    include("footer.html");
    ?>
    <script src="../script/ajout_experiance.js"></script>
</body>

</html>