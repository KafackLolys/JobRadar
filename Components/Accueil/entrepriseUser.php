<?php
// Vérifier si la variable de session existe
if (isset($_SESSION['user_job'])) {
    $user = $_SESSION['user_job'];
    //expériance
    
    $stmt = $pdo->prepare("SELECT nom,prophile FROM entreprise WHERE id_user = :id_user");
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
            echo "<div>";
                if ($row["prophile"]) {
                    echo "<img src='../Projet_de_soutenance/public/entreprises/$row[prophile]'>";
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
                <a  href='http://localhost/Projet_de_soutenance/Components/Connexion.php'><div>Connecter vous &#8594;</div><a>
        </div>
    </div>
    ";
}
?>