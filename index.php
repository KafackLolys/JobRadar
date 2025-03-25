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
    $user = null;
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
    <link rel="stylesheet" href="style/index_general.css">
    <link rel="stylesheet" href="style/header_general.css">
    <link rel="stylesheet" href="style/footer_general.css">
</head>

<body>
    <?php
    //header
    include("Components/header_general.php");
    ?>
    <main>
        <div style="display:flex; flex-direction:row; flex-wrap: wrap; align-items: flex-start;">
            <div class='prophile'>
                <div class='container'>
                    <p>Bienvenue sur <b>JobRadar</b></p>
                    <br><br><br>
                    <h3>Connecter vous pour pouvoir disposer de plus d'options</h3>
                    <br>
                    <p>_________________</p>
                    <fieldset>
                        <legend>Identifier vous sur notre communauté</legend>
                        <a href='Components/Connexion.php'>
                            <div>Connecter vous &#8594;</div>
                        </a>
                        <a href='Components/inscription.php'>
                            <div>S'inscrire &#8594;</div>
                        </a>
                    </fieldset>
                </div>
            </div>

            <div class="exemple_annonce">
                
            </div>

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
                        <div></div>
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
    include("Components/footer_general.html");
    ?>
    <script src="script/index.js"></script>
</body>

</html>