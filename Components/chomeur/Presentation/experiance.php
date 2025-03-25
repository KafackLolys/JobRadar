<?php

session_start();
if (!$_SESSION['user_job']) {
    header("Location: ../../index.php");
    exit();
}
// File
require_once("../../../api/database.php");

$pdo = getConnexion();
tryTable();
//experiance
$stmt = $pdo->prepare("SELECT * FROM experiance WHERE id = :id");
    $stmt->bindParam(':id', $_GET["id_exp"]);
    $stmt->execute();
    $exp = $stmt->fetch(PDO::FETCH_ASSOC);
//piece jointe
$stmt = $pdo->prepare("SELECT * FROM piece_jointe WHERE id_experiance = :id_exp");
    $stmt->bindParam(':id_exp', $_GET["id_exp"]);
    $stmt->execute();
    $pj = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style></style>
    <link rel="stylesheet" href="../../style/presentation_exp.css">
    <link rel="stylesheet" href="../../style/header.css">
    <link rel="stylesheet" href="../../style/footer.css">
    <title>Experiance</title>
</head>

<body>
    <?php
    //header
    include("../header.php");
    ?>
    <main>
       <div class="contenu">
            <div class="c">_ Expériance _</div>
            <div class="c1">
                <h1><u><?php echo"$exp[titre]"; ?></u></h1>
                <p><u>Description</u>: <?php echo" $exp[description]"; ?></p>
            </div> 
            <hr>
            <div class="c2">
                <?php
                    foreach ($pj as $row) {
                        if ($row["type"] == "image") {
                            echo"<div class='part p1'>
                                    <img src='../../public/experiances/$row[element]' alt='image' />
                                    <h2>$row[titre]</h2>
                                    <p>$row[description]</p>
                                </div>";
                        }
                        if ($row["type"] == "document") {
                            //Trouver le dernier point
                            $point = strchr($row["element"], '.');
                            if ($point !== false) {
                                //extraire les caractères qui suivent le point
                                $extension = substr($point, 1);
                            }   
                            echo"<div class='part p2'>
                                    <div class='ext'>$extension</div>
                                    <h2>$row[titre]</h2>
                                    <p>$row[description]</p>
                                    <br>
                                    <a href='../../public/documents/$row[element]' >Ouvrir le document &#8594;</a>
                                    <br><br>
                                </div>";
                        }
                    }
                ?>
            </div>
       </div>
       <div class="opp">
            <a href="#" class="edit" id="edit" onclick="edit_exp();">Modifier 
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.15" d="M4 20H8L18 10L14 6L4 16V20Z" fill="#000000"/>
                <path d="M12 20H20.5M18 10L21 7L17 3L14 6M18 10L8 20H4V16L14 6M18 10L14 6" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="../../../api/delete_exp.php?id_exp=<?php echo $_GET['id_exp'];?>" class="delete">Supprimer
                <svg width="20px" height="20px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        
                    <title>delete [#1487]</title>
                    <desc>Created with Sketch.</desc>
                    <defs>

                </defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Dribbble-Light-Preview" transform="translate(-179.000000, -360.000000)" fill="#000000">
                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                <path d="M130.35,216 L132.45,216 L132.45,208 L130.35,208 L130.35,216 Z M134.55,216 L136.65,216 L136.65,208 L134.55,208 L134.55,216 Z M128.25,218 L138.75,218 L138.75,206 L128.25,206 L128.25,218 Z M130.35,204 L136.65,204 L136.65,202 L130.35,202 L130.35,204 Z M138.75,204 L138.75,200 L128.25,200 L128.25,204 L123,204 L123,206 L126.15,206 L126.15,220 L140.85,220 L140.85,206 L144,206 L144,204 L138.75,204 Z" id="delete-[#1487]">

                                </path>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
       </div>
       <div class="form_edit" id="form_edit">
            <span id="close_form"><b>X</b> Annuler</span>
            <form action="../../../api/update_exp.php" method="post" class="form_content" enctype="multipart/form-data">
                <div style="background-color: #333; color: white; padding: 10px">
                    <h1>Modifier l'experiance</h1>
                </div>
                <em>Si la nouvelle pièce jointe n'est pas sélectionnée l'anciènne serra conservé !</em>
                <div class="frm_ent">
                    <div class="p1">
                        <input type="hidden" name="id_exp" value="<?php echo $exp['id']; ?>">
                        <div class="champ">
                            <label for="titre">Titre</label>
                            <input type="text" id="titre" name="titre" value="<?php echo $exp['titre']; ?>" required>
                        </div>
                        <div class="champ">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" placeholder='Description' required><?php echo" $exp[description]"; ?></textarea>
                        </div>
                    </div>
                    <fieldset class="p2">
                        
                        <legend>Pièce jointe (facultatif)</legend>
                        <div class="champ">
                            <label for="image">Image</label>
                            <div style="display: flex;">
                                <input type="file" name="image" accept="image/*" onchange="previewImage();" id="image">
                                <img id="imagePreview" src="#" alt="Prévisualisation de l'image" style="display: none; max-width: 100px; max-height: 100px;">
                            </div>
                            <div id="champ_i" style="display: none;">
                                <input type="text" name="titre_i" placeholder="Titre de l'image">
                                <textarea name="description_i" id="description_i" placeholder="Description  de l'image"></textarea>
                            </div>
                        </div>
                        <div class="champ">
                            <label>Document (Taille maximale de 2 Mo)</label>
                            <div style="display: flex;">
                                <input type="file" name="document" accept=".doc, .docx, .pdf, .txt, .rtf, .html, .odt, .xml, .csv, .json, .md" onchange="previewFile()" id="doc">
                                <div id="image_svg"></div>
                            </div>
                            <div id="champ_d" style="display: none;">
                                <input type="text" name="titre_d" placeholder="Titre du document">
                                <textarea name="description_d" id="description_d" placeholder="Description du document"></textarea>
                            </div>
                        </div>

                    </fieldset>
                </div>
                <div>
                    <button type="submit">Enregistrer les modifications</button>
                </div>
            </form>
       </div>
    </main>
    <?php
    //footer 
    include("../footer.html");
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var popup = document.getElementById('form_edit');
            var openBtn = document.getElementById('edit');
            var closeBtn = document.getElementById('close_form');

            openBtn.onclick = function () {
                popup.style.display = "flex";
            }

            closeBtn.onclick = function () {
                popup.style.display = "none";
            }
            /*
            window.onclick = function (event) {
                if (event.target == popup) {
                    popup.style.display = "none";
                }
            }*/
        });
    </script>
    <script src="../../script/presentation_exp.js"></script>
</body>

</html>