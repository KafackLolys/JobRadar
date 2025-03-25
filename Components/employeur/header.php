<?php
// Set headers to prevent caching
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); // Expiration de la cache
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Dernière modification
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // Contrôle de la cache
header("Cache-Control: post-check=0, pre-check=0", false); // Contrôle de la cache
header("Pragma: no-cache"); // Pragma pour la cache
?>
<?php

require_once(__DIR__ . "/../../api/database.php");
$pdo = getConnexion();
@session_start();
// Vérifier si la variable de session existe
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Récupérer les informations de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM employeur WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //entreprise

    $stmt = $pdo->prepare("SELECT id, nom,prophile FROM entreprise WHERE id_employeur = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $entreprise = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "
    <div class='entreprise'>
        <div class='container'>
            <br><br><br>
            <h3>Créer  Une Entreprise</h3>
            <br>
                <a  href='Components/Connexion.php'><div>Connecter vous &#8594;</div><a>
        </div>
    </div>
    ";
}
?>
<header>
    <div class="navbar">
        <a href="http://localhost/JobRadar/Components/employeur/index.php" class="logo">Job Radar</a>
        <input required type="search" class="champ_recherche" placeholder="Rechercher...">
        <div>
            <button class="svg" id="openPopup">
            <?php
            // Vérifier si la variable de session existe
            if ($user["prophile"]) {
                echo "<img src='../../public/users/$user[prophile]' width='37px' style='border-radius: 50px;'>";
            } else {
                echo "<svg width='37px' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'>
                    <path
                        d='M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z'
                        fill='#000000' />
                    <path d='M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z' fill='#000000' />
                </svg>";
            }
            ?>
            </button>

            <button class="menu-button" onclick="openSlideBar()">Menu</button>
        </div>
    </div>

    <div id="mySlideBar" class="slide-bar">
        <a class="close" href="javascript:void(0)" onclick="closeSlideBar()">&times;</a>
        <a class="lien" href="http://localhost/JobRadar/Components/employeur/index.php">Accueil</a>
        <a class="lien" href="#">Publication</a>
        <a class="lien" href="#">Abonnement</a>
        <a class="lien" href="#">À propos</a>
        <a class="lien" href="#">Contact</a>
        <a class="lien" href="#">Paramètre</a>
        <a class="lien" href="http://localhost/JobRadar/Components/deconnexion.php">Déconnexion</a>
    </div>

    <!-- popup -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" id="close">&times;</span>
            <br>
            <br>
            <?php
            // Vérifier si la variable de session existe
            if (isset($_SESSION['user_id'])) {
                echo "<a href='http://localhost/JobRadar/Components/employeur/Prophile/prophile.php'><button>Mon Compte</button></a>";
                echo "<a href='http://localhost/JobRadar/Components/Connexion.php'><button>Changer de compte</button></a>";
            } else {
                echo "<a href='http://localhost/JobRadar/Components/Connexion.php'><button>Se connecter</button></a>";
            }
            ?>
            <br>
            <a href="http://localhost/JobRadar/Components/inscription.php"><button>Inscription</button></a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var popup = document.getElementById('popup');
            var openBtn = document.getElementById('openPopup');
            var closeBtn = document.getElementById('close');

            openBtn.onclick = function() {
                popup.style.display = "block";
            }

            closeBtn.onclick = function() {
                popup.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == popup) {
                    popup.style.display = "none";
                }
            }
        });

        function openSlideBar() {
            document.getElementById("mySlideBar").style.width = "250px";
        }

        function closeSlideBar() {
            document.getElementById("mySlideBar").style.width = "0";
        }
    </script>
</header>