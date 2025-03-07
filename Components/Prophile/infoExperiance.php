<?php
// Vérifier si la variable de session existe
if (isset($_SESSION['user_job'])) {
    $user = $_SESSION['user_job'];
    //expériance
    
    $stmt = $pdo->prepare("SELECT id, titre FROM experiance WHERE id_user = :id_user");
    $stmt->bindParam(':id_user', $user["id"]);
    $stmt->execute();
    $experiance = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo"
    <div class='prophile'>
        <div class='conten_exp'>
            
                <h3>Expérience</h3>
        ";
                foreach ($experiance as $row) {
                    echo"<a href='../Presentation/experiance.php?id_exp=$row[id]'><div>$row[titre]</div></a>";
                }
                
    echo"       <a href='../ajout_experiance.php'><div style='background-color: #e9e9e9;'>+ Ajouter une expériance</div></a>
        </div>
    </div>
    ";
}
?>
