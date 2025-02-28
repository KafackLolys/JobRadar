<?php
// Démarrer la session
session_start();
require_once("../../api/database.php");
$pdo = getConnexion();
tryTable();
// Vérifier si la variable de session existe
if (isset($_SESSION['user_job'])) {
    $user = $_SESSION['user_job'];

    //Experiance
    $stmt = $pdo->prepare("SELECT titre FROM experiance WHERE id_user = :id_user");
    $stmt->bindParam(':id_user', $user["id"]);
    $stmt->execute();
    $experiance = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Entreprise
    $stmt = $pdo->prepare("SELECT nom,prophile FROM entreprise WHERE id_user = :id_user");
    $stmt->bindParam(':id_user', $user["id"]);
    $stmt->execute();
    $entreprise = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style></style>
    <link rel="stylesheet" href="../../style/profile.css">
    <link rel="stylesheet" href="../../style/header.css">
    <link rel="stylesheet" href="../../style/footer.css">
    <title>Mon Profile</title>
</head>

<body>
    <?php
    //header
    include("../header.php");
    ?>
    <main>
        
        <div class="all">
            <div class="part d1">
                <img src="../../public/1.png" width="200px" alt="">
                <h3><?php echo "$user[nom] $user[prenom]"; ?></h3>
                <hr>
                <p><?php echo "$user[description]"; ?>
                    Description du compte ... Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis perferendis fugit maxime distinctio ab culpa quisquam saepe laboriosam obcaecati illo quas autem doloribus sunt minus, dignissimos doloremque laudantium debitis molestiae cupiditate sint, aspernatur dolores reprehenderit, vel excepturi? Ipsam mollitia laboriosam saepe eum velit esse ipsa asperiores nisi. Magni animi deleniti architecto quas officiis incidunt perferendis et, ex veritatis amet tempora temporibus earum. In culpa nostrum provident dolore, possimus facilis cum ex praesentium! Veritatis eum numquam at enim ipsum et delectus pariatur error impedit qui nostrum iusto, quibusdam officia aperiam adipisci nam accusamus laborum aliquid. Asperiores veritatis atque consequuntur recusandae ad!</p>
            </div>
            <div class="part d2">
                <p><b>Pays: </b><?php echo "$user[pays]"; ?></p>
                <p><b>Email: </b><?php echo "$user[email]"; ?></p>
                <p><b>Téléphone: </b><?php echo "$user[tel]"; ?></p>
                <br>
                <hr>
                <h3><u>Experiance</u></h3>
                <?php
                echo"
                    <div>
                        ";
                                foreach ($experiance as $row) {
                                    echo"<div class='exp'>$row[titre]</div>";
                                }
                  echo"</div>";
                ?>
            </div>
            <div class="part d3">
            <h2><u>Entreprise</u></h2>
            <br>
            <?php

                foreach ($entreprise as $row) {
                    echo "<div class='ent'>";
                        if ($row["prophile"]) {
                            echo "<img src='../../public/entreprises/$row[prophile]'>";
                        }
                        else {
                            echo "
                                <svg viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                        <path
                                            d='M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z'
                                            fill='#000000' />
                                        <path d='M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z' fill='#000000' />
                                </svg>";
                        }
                        echo"
                                <b>$row[nom]</b>
                            </div>";
                    }
                ?>
            </div>
        </div>
    </main>
    <?php
    //footer 
    include("../footer.html");
    ?>
</body>

</html>