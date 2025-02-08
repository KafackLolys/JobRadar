<?php
// Démarrer la session
session_start();
require_once("api/database.php");
$pdo = getConnexion();
tryTable();
// Vérifier si la variable de session existe
if (isset($_SESSION['user_job'])) {
    $user = $_SESSION['user_job'];
} else {
    echo "<script>
        console.log('Aucune information utilisateur disponible.')
        </script>";
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
</head>

<body>
<?php
//header
include("Components/header.php");
?>
<main>
    <?php
    include("Components/Accueil/infoUser.php");//prophile
    ?>
    <div style="display:flex; flex-direction:column;width: 600px;">
        <div class="publication">
            <h2 style="margin: 20px 0px 0px 20px;">Annonce</h2>
            <br>
            <form class="container">
                <div style="display:flex; flex-direction:row; margin: 0px 0px 0px 20px;">
                    <svg width="28px" height="27px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                            fill="#000000" />
                        <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                    </svg>
                    <input type="text" placeholder='Titre'>
                </div>
                <br>
                <div>
                    <textarea name="" id="" placeholder='Description'></textarea>
                </div>
                <div class="btn_annonce">
                    <button>photo</button>
                    <button>document</button>
                </div>
                <button class="btn_pub">Publier</button>
            </form>
        </div>
        <div style="display: flex; flex-direction: column; background-color: white;">
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
        </div>
        
    </div>
    
    <div style="display:flex; flex-direction:column;">
        <?php
        include("Components/Accueil/entrepriseUser.php");//entreprise
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
include("Components/footer.html");
?>
</body>
</html>