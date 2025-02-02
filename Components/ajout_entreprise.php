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
                <div class="champ">
                    <label for="profile">Porphile (facultatif)</label>
                    <input type="file" name="profile" id="profile">
                </div>
                <div class="champ">
                    <label for="nom">Nom de l'entreprise</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="champ">
                    <label for="description">Description</label>
                    <textarea name="" id="description" placeholder='Description' required></textarea>
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
    include("./footer.html");
    ?>
</body>

</html>