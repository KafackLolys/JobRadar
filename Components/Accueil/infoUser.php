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
        <div class='container'>";
            if ($user["prophile"]) {
                echo "<img src='$user[prophile]' label='prophile'/>";
            }
            else {
                echo "
                <svg width='50px' height='49px' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'>
                    <path
                        d='M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z'
                        fill='#000000' />
                    <path d='M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z' fill='#000000' />
                </svg>";
            }
                echo"
            <h3>$user[nom] $user[prenom]</h3>
            <p style='color: gray; font-size:12px;'>$user[pays]</p>
            <br>
            <p>$user[description] ...</p>
            <fieldset>
                <legend>Expériance</legend>
        ";
                foreach ($experiance as $row) {
                    echo"<a href='Components/Presentation/experiance.php?id_exp=$row[id]'><div>$row[titre]</div></a>";
                }
                
    echo"       <a href='Components/ajout_experiance.php'><div style='background-color: #e9e9e9;'>+ Ajouter une expériance</div></a>
            </fieldset>
        </div>
    </div>
    ";
} else {
    echo"
    <div class='prophile'>
        <div class='container'>
            <p>Bienvenue sur <b>JobRadar</b></p>
            <br><br><br>
            <h3>Connecter vous pour pouvoir disposer de plus d'options</h3>
            <br>
            <p>_________________</p>
            <fieldset>
                <legend>Identifier vous sur notre communauté</legend>
                <a  href='http://localhost/Projet_de_soutenance/Components/Connexion.php'><div>Connecter vous &#8594;</div><a>
                <a  href='http://localhost/Projet_de_soutenance/Components/inscription.php'><div>S'inscrire &#8594;</div><a>
            </fieldset>
        </div>
    </div>
    ";
}
?>
