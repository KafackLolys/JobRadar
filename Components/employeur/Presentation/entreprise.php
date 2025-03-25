<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style></style>
    <link rel="stylesheet" href="../../../style/employeur/presentation_ent.css">
    <link rel="stylesheet" href="../../../style/employeur/header.css">
    <link rel="stylesheet" href="../../../style/employeur/footer.css">
    <title>Entreprise</title>
</head>

<body>
    <?php
    //header
    include("../header.php");

    $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE id = :id");
    $stmt->bindParam(':id', $_GET["id_ent"]);
    $stmt->execute();
    $ent = $stmt->fetch(PDO::FETCH_ASSOC);
    //piece jointe
    $stmt = $pdo->prepare("SELECT * FROM piece_jointe WHERE id_entreprise = :id_ent");
    $stmt->bindParam(':id_ent', $_GET["id_ent"]);
    $stmt->execute();
    $pj = $stmt->fetchALL(PDO::FETCH_ASSOC);
    ?>
    <main>
        <div class="contenu">
            <div class="c">_ Entreprise _</div>
            <div class="c1">
                <div style="display: flex; flex-direction: row; align-items: flex-end;">
                    <img src="../../../public/entreprises/<?php echo ($ent['prophile'] ? $ent['prophile'] : "entreprise_logo.png"); ?>" alt="logo">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="open_form_image" style="background-color: #333; cursor: pointer;">
                        <path opacity="0.15" d="M4 20H8L18 10L14 6L4 16V20Z" fill="#000000" />
                        <path d="M12 20H20.5M18 10L21 7L17 3L14 6M18 10L8 20H4V16L14 6M18 10L14 6" stroke="#ffd700" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h1><u><?php echo "$ent[nom]"; ?></u></h1>
                <p><u>Description</u>: <?php echo " $ent[description]"; ?></p>
            </div>
            <hr>
            <div class="c2">
                <div class="liste">
                    <h2>Pièce jointe</h2>
                    <div style="display: flex; flex-direction: row; flex-wrap: wrap;">
                        <?php
                        foreach ($pj as $row) {
                            if ($row["type"] == "image") {

                                   
                                    echo "
                                    <div class='part p1'>
                                        <img src='../../../public/entreprises/piece_jointe/images/$row[element]' alt='image' />
                                        <h2>$row[titre]</h2>
                                        <p>$row[description]</p>";
                                            ?>
                                                
                                            <div class="action1">
                                                <a href="../../../api/employeur/entreprise/del_piece_jointe.php?id_pj=<?php echo $row['id']?>&id_ent=<?php echo $row['id_entreprise']; ?>"><button class="delete-button">Supprimer</button></a>
                                            </div>
                                        </div>
                                        <?php
                                        
                            }
                            if ($row["type"] == "document") {
                                //Trouver le dernier point
                                $point = strchr($row["element"], '.');
                                if ($point !== false) {
                                    //extraire les caractères qui suivent le point
                                    $extension = substr($point, 1);
                                }
                                echo "<div class='part p2'>
                                            <div class='ext'>$extension</div>
                                            <h2>$row[titre]</h2>
                                            <p>$row[description]</p>
                                            <br>
                                            <br><br>";
                                            ?>
                                            
                                            <div class="action2">
                                                <a href="../../../api/employeur/entreprise/del_piece_jointe.php?id_pj=<?php echo $row['id']?>&id_ent=<?php echo $row['id_entreprise']; ?>"><button class="delete-button">Supprimer</button></a>
                                                <a href="../../../public/entreprises/piece_jointe/documents/<?php echo $row['element'];?>" ><button class="open-button">Ouvrir &#8594;</button></a>
                                            </div>
                                        </div>
                                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="addpj">
                    <fieldset>
                        <legend>Ajouter une pièce jointe</legend>
                        <button class="img" id="addimgform">Image</button>
                        <button class="doc" id="adddocform">Document</button>
                    </fieldset>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h2>Publication</h2>
            <?php include("publication.php");?>
        </div>
        <!-- Fenêtre Image -->

        <div class="container" id="container">

            <div class="popform">
                <span class="close" name="close" id="close_form_img">&times;</span>
                <form method="POST" id="form_img" action="../../../api/employeur/entreprise/add_piece_jointe_image.php" enctype="multipart/form-data">
                    <input type="hidden" name="id_ent" value="<?php echo $ent['id']; ?>">
                    <div class="champ">
                        <label for="imageTitle">Titre de l'image:</label>
                        <input type="text" id="imageTitle" name="imageTitle" required style="height: 40px; padding-left: 7px; font-size:20px">
                    </div>

                    <div class="champ">
                        <label for="imageDescription">Description de l'image:</label>
                        <textarea id="imageDescription" name="imageDescription" required rows="5"></textarea>
                    </div>

                    <div class="champ">
                        <label for="imageUpload">Télécharger une image:</label>
                        <input type="file" id="imageUpload" name="imageUpload" accept="image/*" required>
                        <div class="preview">
                            <img id="imagePreview" src="#" alt="Aperçu de l'image" style="display: none;">
                        </div>
                    </div>




                    <input type="submit" id="save_pj_img" value="Enregistrer">
                </form>
            </div>
        </div>

        <!-- Fenêtre Document -->
        <div class="container" id="form_doc">
            <div class="popform">
                <span class="close" name="close" id="close_form_doc">&times;</span>
                <form class="form_doc" method="POST" action="../../../api/employeur/entreprise/add_piece_jointe_document.php" enctype="multipart/form-data">
                    <input type="hidden" name="id_ent" value="<?php echo $ent['id']; ?>">
                    <div class="champ">
                        <label for="document">Document (Taille maximale de 2 Mo)</label>
                        <div style="display: flex;">
                            <input type="file" name="document" accept=".doc, .docx, .pdf, .txt, .rtf, .html, .odt, .xml, .csv, .json, .md" onchange="previewFile()" id="doc" required>
                            <div id="image_svg"></div>
                        </div>
                        <div id="champ_d" style="display: none;">
                            <input type="text" name="titre_d" placeholder="Titre du document" style="height: 40px; padding-left: 7px; font-size:20px; margin-bottom: 7px;" required>
                            <textarea name="description_d" id="description_d" placeholder="Description du document" rows="5" required></textarea>
                        </div>
                    </div>
                    <button type="submit" id="save_pj_doc">Enregistrer</button>
                </form>
            </div>
        </div>
        <div class="opp">
            <a href="#" class="edit" id="edit" onclick="edit_exp();">Modifier

            </a>
            <a href="../../../api/employeur/entreprise/delete_ent.php?id_ent=<?php echo $_GET['id_ent']; ?>" class="delete">Supprimer
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
                    <!-- edit info entreprise -->
        <div class="form_edit" id="form_edit">
            <span id="close_form"><b>X</b> Annuler</span>
            <form action="../../../api/employeur/entreprise/update_ent.php" method="post" class="form_content" enctype="multipart/form-data">
                <div style="background-color: #333; color: white; padding: 10px">
                    <h1>Modifier l'entreprise</h1>
                </div>
                <div class="frm_ent">
                    <div class="p1">
                        <input type="hidden" name="id_ent" value="<?php echo $ent['id']; ?>">
                        <div class="champ">
                            <label for="titre">Nom</label>
                            <input type="text" id="titre" name="nom" value="<?php echo $ent['nom']; ?>" required>
                        </div>
                        <div class="champ">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" placeholder='Description' required><?php echo " $ent[description]"; ?></textarea>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn_modif">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
        <!-- Fenêtre Profil -->
        <div id="edit_image_entreprise">
            <form action="../../../api/employeur/entreprise/edit_image_entreprise.php" method="post" enctype="multipart/form-data" style="background-color: #fff; padding:20px; border-radius: 5px;">
                <span id="close_form_image" style="background-color: #333; cursor:pointer; color:#fff; padding: 5px;"><b>X</b> Annuler</span>
                <input type="hidden" name="id_ent" value="<?php echo $ent['id']; ?>">
                <div class="champ" style="margin-top: 20px;">
                    <label for="prophile">Prophile</label>
                    <input type="file" name="prophile" accept="image/*" onchange="previewImage();" id="prophile" required>
                    <img id="prophilePreview" src="#" alt="Prévisualisation de l'image" style="display: none; max-width: 200px;">
                </div>
                <button type="submit" style="padding: 7px; margin-top: 20px; font-size: 20px; background-color: #ffd700; border-radius: 5px; border: none;">
                    <b>Modifier</b>
                </button>
            </form>
        </div>
    </main>
    <?php
    //footer 
    include("../footer.html");
    ?>
    <script src="../../../script/employeur/presentation_ent.js"></script>
</body>

</html>