<?php
// Vérifier si la variable de session existe
if (isset($_SESSION['user_job'])) {
    $user = $_SESSION['user_job'];
    //expériance
    
    $stmt = $pdo->prepare("SELECT id, nom,prophile FROM entreprise WHERE id_user = :id_user");
    $stmt->bindParam(':id_user', $user["id"]);
    $stmt->execute();
    $entreprise = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo"
    <div class='entreprise'>
        <div class='container'>
            <h3>Entreprise</h3>
            <br>
            <div class='list'>";
                foreach ($entreprise as $row) {
            echo "<a href='Components/Presentation/entreprise.php?id_ent=$row[id]'>
                    <div class='row'>";
                if ($row["prophile"]) {
                    echo "<div class='cadre_image'style='background-image: url(../JobRadar/public/entreprises/$row[prophile]);'>
                          </div>";
                }
                else {
                    echo "<div class='cadre_image' style='background-image: url(../JobRadar/public/entreprises/entreprise_logo.png);'>
                          </div>";

                }
                echo"
                        <b>$row[nom]</b>
                    </div>
                  </a>";
                }
                echo "  
                    <a href='Components/ajout_entreprise.php'><div class='ajout_exp'>+ Ajouter Une Entreprise</div></a>
                </div>
            </div>
        </div>";
} else {
    echo"
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