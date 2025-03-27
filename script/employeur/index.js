function validateForm() {
    const titre = document.querySelector('input[name="titre"]').value;
    const description = document.querySelector('textarea[name="description"]').value;

    if (!titre || !description) {
        alert("Veuillez remplir tous les champs.");
        return false;
    }

    return true;
}

function previewImage() {
    const file = document.getElementById('image_pub').files[0];
    const preview = document.getElementById('imagePreview');
    const reader = new FileReader();

    reader.onloadend = function () {
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

    // Récupérer les données du formulaire
    const formData = new FormData(document.getElementById('pub_annonce'));

    // Vérifiez si une image a été sélectionnée
    const imageInput = document.querySelector('input[type="file"]');
    if (imageInput.files.length > 0) {
        const file = imageInput.files[0];
        // Vous pouvez éventuellement vérifier le type et la taille du fichier ici
        console.log("Image sélectionnée : ", file.name);
    } else {
        console.log("Aucune image sélectionnée.");
    }

    // Envoyer les données avec fetch
    fetch('api/annonce/add_annonce.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            // Traitez la réponse ici
            if (data.success) {
                getPub(); // Recharger les pubs
                console.log(data.message);
                // Réinitialisez le formulaire ou redirigez
                document.getElementById('pub_annonce').reset();
                document.getElementById('imagePreview').src = ''; // Réinitialiser l'aperçu de l'image
            } else {
                console.log('Une erreur est survenue : ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            console.log('Une erreur est survenue lors de l\'envoi.');
        });
}

/*_______________________________________ Selection des pub _________________________________________ */
function getPub() {
    // script/index.js
    document.addEventListener("DOMContentLoaded", function () {
        fetch('api/annonce/selectAllAnnonce.php')
            .then(response => response.json())
            .then(annonces => {
                const mainContainer = document.getElementById('annoncesContainer');

                // Nettoyer le contenu précédent
                mainContainer.innerHTML = '';

                annonces.forEach(annonce => {
                    // Créer une nouvelle div pour chaque annonce
                    const annonceDiv = document.createElement('div');
                    annonceDiv.classList.add('new_pub'); // ajouter la classe 'new_pub'
                    annonceDiv.innerHTML = `
                    <div class="container">
                        <div style="display: flex; align-items: center;">
                            <svg width="28px" height="27px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="#000000" />
                                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#000000" />
                            </svg>
                            <p style="padding-left: 10px;">${annonce.nom_utilisateur}</p>
                        </div>
                        <br>
                        <h3>${annonce.titre}</h3>
                        <p>${annonce.description}</p>
                        <a href="#" class="link">Consulter &#8594;</a>
                    </div>
                    <img src="public/annonces/${annonce.image}" alt="Image de l'annonce">
                `;
                    mainContainer.appendChild(annonceDiv);
                });
            })
            .catch(error => console.error('Erreur:', error));
    });
}
//afficher les pub au chargement de la page
getPub();