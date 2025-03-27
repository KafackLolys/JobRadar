<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        header("Location: ../../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../style/employeur/header.css">
    <link rel="stylesheet" href="../../../style/employeur/footer.css">
    <title>Annonce de Recherche d'Emploi</title>
</head>

<body>
    <?php
    //header
    include("../header.php");

    $stmt = $pdo->prepare("SELECT * FROM annonce WHERE id = :id");
    $stmt->bindParam(':id', $_GET["id"]);
    if (!$stmt->execute()) {
        echo "Erreur de base de données.";
        exit();
    }
    else{
        
    }
    $annonce = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <main>
        <div class="job-posting">
            <h1><?php echo $annonce["titre"]; ?></h1>
            <p><?php echo $annonce["description"]; ?>.</p>
            <div class='img_annonce' style="background-image: url(../../../public/annonces/<?php echo $annonce["image"];?>);"></div>
            <div class="likes">
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.2699 16.265L20.9754 12.1852C21.1516 11.1662 20.368 10.2342 19.335 10.2342H14.1539C13.6404 10.2342 13.2494 9.77328 13.3325 9.26598L13.9952 5.22142C14.1028 4.56435 14.0721 3.892 13.9049 3.24752C13.7664 2.71364 13.3545 2.28495 12.8128 2.11093L12.6678 2.06435C12.3404 1.95918 11.9831 1.98365 11.6744 2.13239C11.3347 2.29611 11.0861 2.59473 10.994 2.94989L10.5183 4.78374C10.3669 5.36723 10.1465 5.93045 9.86218 6.46262C9.44683 7.24017 8.80465 7.86246 8.13711 8.43769L6.69838 9.67749C6.29272 10.0271 6.07968 10.5506 6.12584 11.0844L6.93801 20.4771C7.0125 21.3386 7.7328 22 8.59658 22H13.2452C16.7265 22 19.6975 19.5744 20.2699 16.265Z" fill="#1C274C" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.96767 9.48508C3.36893 9.46777 3.71261 9.76963 3.74721 10.1698L4.71881 21.4063C4.78122 22.1281 4.21268 22.7502 3.48671 22.7502C2.80289 22.7502 2.25 22.1954 2.25 21.5129V10.2344C2.25 9.83275 2.5664 9.5024 2.96767 9.48508Z" fill="#1C274C" />
                </svg> 42
            </div>
        </div>
        <button class="btn_cloture">Fermer l'annonce</button>
        <div class="applicants">
            <h2>Personnes ayant postulé :</h2>
            <div class="applicant">
                <div class='cadre_image' style="background-image: url(../../../public/annonces/41742924716.png);"></div>
                <div>
                    <strong>Jean Dupont</strong><br>
                    <small>Date de postulation : 01/03/2025</small>
                </div>
            </div>
            <div class="applicant">
                <div class='cadre_image' style="background-image: url(../../../public/annonces/41742924716.png);"></div>
                <div>
                    <strong>Marie Curie</strong><br>
                    <small>Date de postulation : 02/03/2025</small>
                </div>
            </div>
            <div class="applicant">
                <div class='cadre_image' style="background-image: url(../../../public/annonces/41742924716.png);"></div>
                <div>
                    <strong>Pierre Martin</strong><br>
                    <small>Date de postulation : 03/03/2025</small>
                </div>
            </div>
        </div>

        <div class="comments">
            <h2>Commentaires :</h2>
            <div class="comment">
                <div style="display: flex;">
                    <div class='cadre_image' style="background-image: url(../../../public/annonces/41742924716.png);"></div>
                    <div>
                        <p class="author">Alice</p>
                        <p>C'est une excellente opportunité !</p>
                        <p class="date">10/03/2025</p>
                    </div>
                </div>
                <div class="delete_cmt">X</div>
            </div>
            <div class="comment">
                <div style="display: flex;">
                    <div class='cadre_image' style="background-image: url(../../../public/annonces/41742924716.png);"></div>
                    <div>
                        <p class="author">Alice</p>
                        <p>C'est une excellente opportunité !</p>
                        <p class="date">10/03/2025</p>
                    </div>
                </div>
                <div class="delete_cmt">X</div>
            </div>
            <div class="comment">
                <div style="display: flex;">
                    <div class='cadre_image' style="background-image: url(../../../public/annonces/41742924716.png);"></div>
                    <div>
                        <p class="author">Alice</p>
                        <p>C'est une excellente opportunité !</p>
                        <p class="date">10/03/2025</p>
                    </div>
                </div>
                <div class="delete_cmt">X</div>
            </div>

        </div>
        <style>
            body {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            main {
                display: flex;
                flex-wrap: wrap;
                width: 100%;
                justify-content: space-between;
            }

            .job-posting {
                background: white;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                width: calc(45% - 40px);
                margin-bottom: 20px;
                box-sizing: border-box;
            }

            .job-posting h1 {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .job-posting .img_annonce {
                max-width: 100%;
                padding-top: 56.25%; /* Ratio 16:9 (hauteur/largeur * 100) */
                background-color: #ffffff;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
            }

            .likes {
                margin-top: 10px;
                font-weight: bold;
                display: flex;
                align-items: center;
            }

            .applicants {
                background: white;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                width: 500px;
                box-sizing: border-box;
            }

            .applicants h2 {
                font-size: 20px;
            }

            .applicant {
                display: flex;
                align-items: center;
                margin-top: 10px;
                border-bottom: 1px solid #ccc;
            }

            .comments {
                background: white;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                width: 100%;
                margin-top: 20px;
                box-sizing: border-box;
            }

            .comments h2 {
                font-size: 20px;
            }

            .comment {
                background: #f9f9f9;
                padding: 15px;
                margin: 10px 0;
                border-radius: 4px;
                position: relative;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .comment::before {
                content: '';
                position: absolute;
                top: 15px;
                left: -10px;
                width: 5px;
                height: 100%;
                background-color: #007bff;
                /* Couleur de la barre de côté */
                border-radius: 4px;
            }

            .comment p {
                margin: 0;
            }

            .comment .author {
                font-weight: bold;
            }

            .comment .date {
                font-size: 12px;
                color: #777;
            }

            .delete_cmt {
                font-size: 40px;
                transition: 0.3s;
                padding: 10px;
                border-radius: 5px;
            }

            .delete_cmt:hover {
                background-color: rgb(232, 120, 120);
                color: white;
                cursor: pointer;
            }

            .cadre_image {
                margin-right: 5px;
                height: 50px;
                width: 50px;
                border-radius: 50%;
                background-color: #ffffff;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            .btn_cloture {
                padding: 10px;
                height: 50px;
                margin: 10px;
                background-color: rgb(249, 245, 183);
                border: none;
                border-radius: 5px;
                font-weight: bold;
                cursor: pointer;
                box-shadow: 3px 3px 5px rgba(255, 0, 0, 0.36);
                border: solid rgba(255, 0, 0, 0.36) 1px;
                transition: 0.3s;
            }
            .btn_cloture:hover {
                background-color: rgba(255, 0, 0, 0.15);
            }

            /* Styles responsives */
            @media (max-width: 768px) {

                .job-posting,
                .applicants {
                    width: 100%;
                    /* Prend toute la largeur sur mobile */
                }

                .applicants {
                    margin-bottom: 20px;
                }
            }
        </style>
    </main>
    <?php
    //footer 
    include("../footer.html");
    ?>
</body>

</html>