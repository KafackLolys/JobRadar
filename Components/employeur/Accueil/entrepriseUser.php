<?php

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
?>