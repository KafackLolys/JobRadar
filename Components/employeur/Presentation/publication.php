    <div>
        <img id="addfrmannonce" src="../../../public/add.png" alt="publier" width="100px" style="cursor: pointer;">
    </div>
    <div id="annoncesContainer" style="display: flex; flex-direction: row; flex-wrap: wrap;">
        <!-- Les divs 'post-container' seront ajoutées ici grace au javascrip dans la fonction getPub -->

    </div>
    <style>
        .post-container {
            margin: 20px;
            max-width: 600px;
            min-width: 300px;
            min-height: 200px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .post-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .content_and_image {
            display: flex;
            justify-content: space-between;
            height: 100%;
            align-items: flex-start;
        }

        .post-content {
            width: 100%;
            color: #555;
            margin-right: 10px;
        }

        .post-image {
            text-align: right;
            display: flex;
            justify-content: center;
        }

        .post-image img {
            max-width: 300px;
            min-width: 200px;
            border-radius: 8px;
        }

        .post-actions button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .post-content p {
            min-width: 200px;
        }

        .option-post {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post-like {
            justify-content: flex-end;
            display: flex;
            align-items: center;
        }

        @media (max-width: 600px) {

            .post-container {
                margin: 10px;
                width: 100%;
            }
            .post-image {
                width: 100%;
            }

            .post-image img {
                width: auto;
                border-radius: 8px;
            }

            .post-content p {
                min-width: 10px;
            }

            .content_and_image {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
    <!-- Formulai de l'annonce en Popup -->
    <div id="frmannoncepopup">
        <div class="publication">
            <div style="display: flex; justify-content: space-between;">
                <h2 style="margin: 20px 0px 0px 20px;">Annonce</h2>
                <p id="closefrmannoncepopup">X</p>
            </div>
            <br>
            <form id="pub_annonce" onsubmit="return handleSubmit(event);" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                <input type="hidden" name="id_entreprise" value="<?php echo $_GET['id_ent']; ?>">
                <div style="display:flex; flex-direction:row; margin: 0px 0px 0px 20px; align-items: center;">
                    <div class='type_img' style='background-image: url(../../../public/entreprises/<?php echo ($ent['prophile'] ? $ent['prophile'] : "entreprise_logo.png"); ?>);'></div>
                    <input type="text" placeholder='Titre' name="titre" required>
                </div>
                <br>
                <div>
                    <textarea name="description" placeholder='Description' required></textarea>
                </div>
                <div class="btn_annonce">
                    <div class="div_image" style="background-color:rgba(255, 217, 0, 0.4); padding: 5px;">
                        <img src="" id="imagePreviewAnnonce" style="width: 50px;">
                    </div>
                    <input type="file" name="image" accept="image/*" onchange="previewImageAnnonce();" id="image_pub_annonce" style="display: none;">
                    <label for="image_pub_annonce">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer; border-radius: 5px;">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6C3 4.34315 4.34315 3 6 3H18C19.6569 3 21 4.34315 21 6V16.999V17.001V18C21 19.6569 19.6569 21 18 21H6C4.34315 21 3 19.6569 3 18V14V6ZM19 6V14.5858L15.7071 11.2929C15.3166 10.9024 14.6834 10.9024 14.2929 11.2929L13 12.5858L9.20711 8.79289C8.81658 8.40237 8.18342 8.40237 7.79289 8.79289L5 11.5858V6C5 5.44772 5.44772 5 6 5H18C18.5523 5 19 5.44772 19 6ZM5 18V14.4142L8.5 10.9142L12.2929 14.7071C12.6834 15.0976 13.3166 15.0976 13.7071 14.7071L15 13.4142L19 17.4142V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18ZM14.5 10C15.3284 10 16 9.32843 16 8.5C16 7.67157 15.3284 7 14.5 7C13.6716 7 13 7.67157 13 8.5C13 9.32843 13.6716 10 14.5 10Z" fill="#ffd700" />
                        </svg>
                    </label>
                </div>
                <button class="btn_pub" type="submit">Publier</button>
            </form>
        </div>
    </div>

    <style>
        #frmannoncepopup {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.62);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .publication {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            transition: 0.5s;
            margin-bottom: 10px;
            width: 500px;
        }

        #closefrmannoncepopup {
            font-size: 50px;
            cursor: pointer;
            transition: 0.3s;
        }

        #closefrmannoncepopup:hover {
            color: rgb(156, 133, 0);
        }

        .publication #pub_annonce {
            display: flex;
            flex-direction: column;
        }


        .publication #pub_annonce input {
            width: 100%;
            margin-left: 10px;
            margin-right: 20px;
            border-radius: 5px;
            padding-left: 7px;
            height: 50px;
            font-size: 25px;
            color: #333;
        }

        .publication #pub_annonce textarea {
            margin-left: 20px;
            margin-right: 10px;
            width: 80%;
            height: 100px;
            font-size: 20px;
            padding: 15px;
        }

        .publication #pub_annonce .btn_annonce {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin: 0px 10px 10px;
        }

        .publication #pub_annonce .btn_annonce button {
            height: 40px;
            width: 100px;
            border-radius: 5px;
            border: none;
            background-color: #666;
            color: white;
        }

        .publication #pub_annonce .type_img {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            width: 60px;
            height: 50px;
            border-radius: 50%;
        }

        .publication #pub_annonce .btn_pub {
            padding: 10px;
            margin-left: 20px;
            margin-bottom: 10px;
            font-size: 20px;
            width: 150px;
            border-radius: 10px;
            border: none;
            background-color: #ffd700;
            font-style: oblique;
            font-weight: bold;
            transition: 0.3s;
        }

        .publication #pub_annonce .btn_pub:hover {
            box-shadow: 3px 3px 3px #aff1bab5;
        }
    </style>
    <script>
        //Form annonce
        document.addEventListener('DOMContentLoaded', (event) => {
            var popup = document.getElementById('frmannoncepopup');
            var openBtn = document.getElementById('addfrmannonce');
            var closeBtn = document.getElementById('closefrmannoncepopup');

            openBtn.onclick = function() {
                popup.style.display = "flex";
            }

            closeBtn.onclick = function() {
                popup.style.display = "none";
            }

        });

        function previewImageAnnonce() {
            const file = document.getElementById('image_pub_annonce').files[0];
            const preview = document.getElementById('imagePreviewAnnonce');
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }

        /*____________________________________ Envoie du formulaire __________________________________________ */
        function handleSubmit(event) {
            // Empêcher l'envoi normal du formulaire
            event.preventDefault();
            var popup = document.getElementById('frmannoncepopup');
            // Récupérer les données du formulaire
            const formData = new FormData(document.getElementById('pub_annonce'));

            // Vérifiez si une image a été sélectionnée
            const imageInput = document.querySelector('input[type="file"]');
            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                console.log("Image sélectionnée : ", file.name);
            } else {
                console.log("Aucune image sélectionnée.");
            }

            // Envoyer les données avec fetch
            fetch('../../../api/employeur/annonce/add_annonce.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Traitez la réponse ici
                    if (data.success) {
                        console.log(data.message);
                        // Réinitialisez le formulaire ou redirigez
                        document.getElementById('pub_annonce').reset();
                        document.getElementById('imagePreview').src = ''; // Réinitialiser l'aperçu de l'image
                        popup.style.display = "none"; //masquer le formulaire
                        getPub(); // Recharger les pubs
                    } else {
                        console.log('Une erreur est survenue : ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    console.log('Une erreur est survenue lors de l\'envoi.');
                });
            getPub(); // Recharger les pubs
        }

        /*_______________________________________ Selection des pub _________________________________________ */
        function getPub() {
            const url = new URL(window.location.href);
            const id_ent = url.searchParams.get('id_ent');
            const infoEntreprise = new FormData();
            infoEntreprise.append('id_entreprise', id_ent);

            document.addEventListener("DOMContentLoaded", function() {
                fetch('../../../api/employeur/annonce/selectAllAnnonce.php', {
                        method: 'POST',
                        body: infoEntreprise
                    })
                    .then(response => response.json())
                    .then(annonces => {

                        const mainContainer = document.getElementById('annoncesContainer');

                        // Nettoyer le contenu précédent
                        mainContainer.innerHTML = '';

                        annonces.forEach(annonce => {

                            // Créer une nouvelle div pour chaque annonce
                            const annonceDiv = document.createElement('div');
                            annonceDiv.classList.add('post-container'); // ajouter la classe 'new_pub'
                            annonceDiv.innerHTML = `
                        <div class="post-title">${annonce.titre}</div>
                        <div class="content_and_image">
                            <div class="post-content">
                                <p>${annonce.description}.</p>
                            </div>
                            <div class="post-image"${annonce.image ? '' : "style = 'display: none;'"}>
                                <img src="../../../public/annonces/${annonce.image}" alt="Description de l'image">
                            </div>
                        </div>
                        <div class="option-post">
                            <div class="post-actions">
                                <a href="annonce.php?id=${annonce.id}"><button>Consulter</button></a>
                            </div>
                            <div class="post-like">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.2699 16.265L20.9754 12.1852C21.1516 11.1662 20.368 10.2342 19.335 10.2342H14.1539C13.6404 10.2342 13.2494 9.77328 13.3325 9.26598L13.9952 5.22142C14.1028 4.56435 14.0721 3.892 13.9049 3.24752C13.7664 2.71364 13.3545 2.28495 12.8128 2.11093L12.6678 2.06435C12.3404 1.95918 11.9831 1.98365 11.6744 2.13239C11.3347 2.29611 11.0861 2.59473 10.994 2.94989L10.5183 4.78374C10.3669 5.36723 10.1465 5.93045 9.86218 6.46262C9.44683 7.24017 8.80465 7.86246 8.13711 8.43769L6.69838 9.67749C6.29272 10.0271 6.07968 10.5506 6.12584 11.0844L6.93801 20.4771C7.0125 21.3386 7.7328 22 8.59658 22H13.2452C16.7265 22 19.6975 19.5744 20.2699 16.265Z" fill="#1C274C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.96767 9.48508C3.36893 9.46777 3.71261 9.76963 3.74721 10.1698L4.71881 21.4063C4.78122 22.1281 4.21268 22.7502 3.48671 22.7502C2.80289 22.7502 2.25 22.1954 2.25 21.5129V10.2344C2.25 9.83275 2.5664 9.5024 2.96767 9.48508Z" fill="#1C274C" />
                                </svg>
                                <p>${annonce.likes}</p>
                            </div>
                        </div>
                `;
                            mainContainer.appendChild(annonceDiv);
                        });
                    })
                    .catch(error => console.error('Erreur:', error));
            });
        }
        //afficher les pub au chargement de la page
        getPub();
    </script>