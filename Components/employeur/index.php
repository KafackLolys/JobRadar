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
    <title>Prophile</title>
    <link rel="stylesheet" href="../../style/employeur/prophile.css">
    <link rel="stylesheet" href="../../style/employeur/header.css">
    <link rel="stylesheet" href="../../style/employeur/footer.css">
</head>

<body>
    <?php
    //header
    include("header.php");
    ?>
    <main>
        <div style="display:flex; flex-direction:column;width: 600px;">
            <div class="info_compte">
                <br>
                <div class="container">
                    
                    <div class="img">
                        <?php
                        //var_dump($user);
                            if ($user["prophile"]) {
                                echo "<div class='type_img' style='background-image: url(../../public/users/$user[prophile]);'></div>";
                                ?>
                                <svg width="20px" height="20px"  id="open_form_image" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="background-color: #333; cursor: pointer;">
                                    <path opacity="0.15" d="M4 20H8L18 10L14 6L4 16V20Z" fill="#000000" />
                                    <path d="M12 20H20.5M18 10L21 7L17 3L14 6M18 10L8 20H4V16L14 6M18 10L14 6" stroke="#ffd700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <?php
                                
                            } else {
                                echo "
                                <svg width='150px' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg' style='margin-left: 20px;'>
                                    <path
                                        d='M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z'
                                        fill='#000000' />
                                    <path d='M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z' fill='#000000' />
                                </svg>";
                            ?>
                                <svg width="20px" height="20px"  id="open_form_image" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="background-color: #333; cursor: pointer;">
                                    <path opacity="0.15" d="M4 20H8L18 10L14 6L4 16V20Z" fill="#000000" />
                                    <path d="M12 20H20.5M18 10L21 7L17 3L14 6M18 10L8 20H4V16L14 6M18 10L14 6" stroke="#ffd700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            <?php
                            }
                    echo"</div>
                        <div class='texte'>";
                            echo "
                            <h3>$user[nom] $user[prenom]</h3>
                            <p style='color: gray; font-size:12px;'>$user[pays]</p>
                        </div>
                            ";
                        ?>
                </div>
                
                <p style="margin: 20px;">
                    <?php
                        echo "$user[description] ...";
                    ?>
                </p>
            </div>
            <div style="display: flex; flex-direction: column; background-color: white;">
                <div style="width: 100%; background-color:rgba(255, 217, 0, 0.63); text-align: center; padding-top: 5px;">
                    <h3>Annonces</h3>
                </div>

                <div class="new_pub">
                    <div class="container">
                        <div style="display: flex; align-items: center;">
                            <img src="../../public/iuc_logo.png" alt="" style="width: 27px; height: 27px;; object-fit: fill;">
                            <p style="padding-left: 10px;">IUC Dschang</p>
                        </div>
                        <br>
                        <h3>Recrutement d’un enseignant en mécatronique</h3>
                        <p>L’IUC de Dschang lance un recrutement d’un enseignant en mécatronique. La date limite de postulation est le 10-02-2025.</p>
                        <a href="#" class="link">Consulter &#8594;</a>
                    </div>
                    <img src="../../public/téléchargement.jfif" alt="Image de l'emploi 2">
                </div>
             
                <div class="new_pub">
                    <div class="container">
                        <div style="display: flex; align-items: center;">
                            <svg width="28px" height="27px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                    fill="#000000" />
                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                            </svg>
                            <p style="padding-left: 10px;">Nom et prenom</p>
                        </div>
                        <br>
                        <h3>Desiue</h3>
                        <p>Participez à la création de designs innovants et attrayants pour nos projets clients.</p>
                        <a href="#" class="link">Consulter &#8594;</a>
                    </div>
                    <img src="public/3.png" alt="Image de l'emploi 2">
                </div>
                <div class="new_pub">
                    <div class="container">
                        <div style="display: flex; align-items: center;">
                            <svg width="28px" height="27px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                    fill="#000000" />
                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                            </svg>
                            <p style="padding-left: 10px;">Nom et prenom</p>
                        </div>
                        <br>
                        <h3>Desiue</h3>
                        <p>Participez à la création de designs innovants et attrayants pour nos projets clients.</p>
                        <a href="#" class="link">Consulter &#8594;</a>
                    </div>
                    <img src="public/1.png" alt="Image de l'emploi 2">
                </div>
                <div class="new_pub">
                    <div class="container">
                        <div style="display: flex; align-items: center;">
                            <svg width="28px" height="27px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                    fill="#000000" />
                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                            </svg>
                            <p style="padding-left: 10px;">Nom et prenom</p>
                        </div>
                        <br>
                        <h3>Desiue</h3>
                        <p>Participez à la création de designs innovants et attrayants pour nos projets clients.</p>
                        <a href="#" class="link">Consulter &#8594;</a>
                    </div>
                    <img src="public/2.png" alt="Image de l'emploi 2">
                </div>
                <div class="new_pub">
                    <div class="container">
                        <div style="display: flex; align-items: center;">
                            <svg width="28px" height="27px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                    fill="#000000" />
                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                            </svg>
                            <p style="padding-left: 10px;">Nom et prenom</p>
                        </div>
                        <br>
                        <h3>Desiue</h3>
                        <p>Participez à la création de designs innovants et attrayants pour nos projets clients.</p>
                        <a href="#" class="link">Consulter &#8594;</a>
                    </div>
                    <img src="public/3.png" alt="Image de l'emploi 2">
                </div>
                <div class="new_pub">
                    <div class="container">
                        <div style="display: flex; align-items: center;">
                            <svg width="28px" height="27px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                    fill="#000000" />
                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                            </svg>
                            <p style="padding-left: 10px;">Nom et prenom</p>
                        </div>
                        <br>
                        <h3>Desiue</h3>
                        <p>Participez à la création de designs innovants et attrayants pour nos projets clients.</p>
                        <a href="#" class="link">Consulter &#8594;</a>
                    </div>
                    <img src="public/2.png" alt="Image de l'emploi 2">
                </div>
                <div class="new_pub" style="margin-bottom: 50px;">
                    <div class="container" style="background-color: #ffd700;">
                        <a href="#" class="link" style="color: #333; background-color: #ffd700;">Voir plus d'annonces &#8594;</a>
                    </div>
                </div>
                
            </div>

        </div>

        <div style="display:flex; flex-direction:column;">
            <?php
            include("Prophile/entrepriseProphile.php"); //dossier prophile
            ?>
            
        </div>
                        <!-- edit photo profil -->
        <div id="edit_photo_prophile">
            <form action="../../api/employeur/prophile/edit_photo_prophile.php" method="post" enctype="multipart/form-data" style="background-color: #fff; padding:20px; border-radius: 5px;">
                <span id="close_form_image" style="background-color: #333; cursor:pointer; color:#fff; padding: 5px;"><b>X</b> Annuler</span>
                <div class="champ" style="margin-top: 20px;">
                    <label for="prophile">Prophile</label>
                    <input type="file" name="prophile" accept="image/*" onchange="previewImage();" id="prophile" required>
                    <img id="prophilePreview" src="#" alt="Prévisualisation de l'image" style="display: none; max-width: 200px;">
                </div>
                <button type="submit" style="padding: 7px; margin-top: 20px; font-size: 20px; background-color: #ffd700; border-radius: 5px; border: none;">
                    <b>Modifier</b>
                </button>
            </form>
        </div>
    </main>
    <?php
    //footer
    include("footer.html");
    ?>
    <script src="../../script/employeur/prophile.js"></script>
</body>

</html>