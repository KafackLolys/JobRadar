<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        header("Location: ../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../../style/chomeur/index.css">
    <link rel="stylesheet" href="../../style/chomeur/header.css">
    <link rel="stylesheet" href="../../style/chomeur/footer.css">
</head>

<body>
    <?php
    //header
    include("header.php");
    ?>
    <main>
        <?php
        include("Components/Accueil/infoUser.php"); //prophile
        ?>
        <div style="display:flex; flex-direction:column;width: 600px;">

            <div class="publication" <?php echo $user ? '' : "style='display: none;'"; ?>>
                <h2 style="margin: 20px 0px 0px 20px;">Annonce</h2>
                <br>
                <form class="container" id="pub_annonce"  onsubmit="return handleSubmit(event);" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                    <div style="display:flex; flex-direction:row; margin: 0px 0px 0px 20px;">
                        <?php
                        if ($user["prophile"]) {
                            echo "<div class='type_img' style='background-image: url(public/users/$user[prophile]);'></div>";
                        } else {
                            echo "
                    <svg width='28px' height='27px' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg' style='margin-left: 20px;'>
                        <path d='M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z' fill='#000000' />
                        <path d='M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z' fill='#000000' />
                    </svg>";
                        }
                        ?>
                        <input type="text" placeholder='Titre' name="titre" required>
                    </div>
                    <br>
                    <div>
                        <textarea name="description" placeholder='Description' required></textarea>
                    </div>
                    <div class="btn_annonce">
                        <div class="div_image" style="background-color:rgba(255, 217, 0, 0.4); padding: 5px;">
                            <img src="" id="imagePreview" style="width: 50px;">
                        </div>
                        <input type="file" name="image" accept="image/*" onchange="previewImage();" id="image_pub" style="display: none;">
                        <label for="image_pub">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer; border-radius: 5px;">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6C3 4.34315 4.34315 3 6 3H18C19.6569 3 21 4.34315 21 6V16.999V17.001V18C21 19.6569 19.6569 21 18 21H6C4.34315 21 3 19.6569 3 18V14V6ZM19 6V14.5858L15.7071 11.2929C15.3166 10.9024 14.6834 10.9024 14.2929 11.2929L13 12.5858L9.20711 8.79289C8.81658 8.40237 8.18342 8.40237 7.79289 8.79289L5 11.5858V6C5 5.44772 5.44772 5 6 5H18C18.5523 5 19 5.44772 19 6ZM5 18V14.4142L8.5 10.9142L12.2929 14.7071C12.6834 15.0976 13.3166 15.0976 13.7071 14.7071L15 13.4142L19 17.4142V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18ZM14.5 10C15.3284 10 16 9.32843 16 8.5C16 7.67157 15.3284 7 14.5 7C13.6716 7 13 7.67157 13 8.5C13 9.32843 13.6716 10 14.5 10Z" fill="#ffd700" />
                            </svg>
                        </label>
                    </div>
                    <button class="btn_pub" type="submit">Publier</button>
                </form>
            </div>
                    <!-- Masauer l'annonce si utilisateur pas connecter-->
            <div class="publication" <?php echo $user ? "style='display: none;'" : ''; ?>>
                <h2 style="margin: 20px 0px 0px 20px;">Aucun utilisateur enregistré</h2>
                <br>
            </div>
                    <!-- Fin annonce -->
            <div  id="annoncesContainer" style="display: flex; flex-direction: column; background-color: #F0F0F0;">
                <!-- Les divs 'new_pub' seront ajoutées ici grace au javascrip dans la fonction getPub -->
            </div>
        </div>
            <!-- Fin pub -->
        <div style="display:flex; flex-direction:column;">
            <?php
            include("Components/Accueil/entrepriseUser.php"); //entreprise
            ?>
            <div class="proposition">
                <div class="container">
                    <h3>Suggestions</h3>
                    <br>
                    <div class="list">
                        <div>
                            <svg width="50px" height="49px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                    fill="#000000" />
                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                            </svg>
                            <div style="display:flex; flex-direction:column; align-items: flex-start;">
                                <h4>Entreprise 1</h4>
                                <p style="font-size: 14px;">Description sefewfsfsdf sdfs</p>
                                <button>+ Suivre</button>
                            </div>
                        </div>
                        <div>
                            <svg width="50px" height="49px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                    fill="#000000" />
                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                            </svg>
                            <div style="display:flex; flex-direction:column; align-items: flex-start;">
                                <h4>Entreprise 1</h4>
                                <p style="font-size: 14px;">Description sefewfsfsdf sdfs</p>
                                <button>+ Suivre</button>
                            </div>
                        </div>
                        <a href="#" style="color: #88781f;">Voir plus &#8594;</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    //footer
    include("footer.html");
    ?>
    <script src="script/index.js"></script>
</body>

</html>
