<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style></style>
    <link rel="stylesheet" href="../style/entreprise.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <title>Créer une entreprise</title>
</head>
<body>
<?php
//header
include("header.html");
?>
    <main>
        <div class="frm_ent">
        <form action="" method="post">
            <div>
                <label for="nom">Porphile (facultatif)</label>
                <input type="file" name="" id="">
            </div>
            <div>
                <label for="nom">Nom de l'entreprise</label>
                <input type="text" id="nom" name="nom">
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="" id="description" placeholder='Description'></textarea>
            </div>
        </form>
        <div bgcolor="bleu"></div>
        </div>
        
    </main>
<?php
//footer
include("./footer.html");
?>
</body>
</html>