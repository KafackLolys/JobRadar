document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const motdepasse = document.getElementById('motdepasse').value;
    const confirmation = document.getElementById('confirmation').value;
    const email = document.getElementById('email').value;
    const errorMessage = document.getElementById('error-message');
    const passwordError = document.getElementById('password-error');
    const emailError = document.getElementById('email-error');
    const loadingMessage = document.getElementById('loading-message');

    // Réinitialiser les messages d'erreur
    errorMessage.style.display = 'none';
    passwordError.style.display = 'none';
    emailError.style.display = 'none';

    // Vérification des critères du mot de passe
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{6,}$/;
    if (!passwordRegex.test(motdepasse)) {
        passwordError.style.display = 'block'; // Afficher le message d'erreur du mot de passe
        return;
    }

    // Vérification de la correspondance des mots de passe
    if (motdepasse !== confirmation) {
        errorMessage.style.display = 'block'; // Afficher le message d'erreur
        return;
    }
    
    // Afficher le message de chargement
    loadingMessage.style.display = 'block';

    // Collecte des données du formulaire
    const formData = new FormData(this);

    // Envoi des données avec fetch
    fetch('../api/verification_email.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        // Masquer le message de chargement
        loadingMessage.style.display = 'none';

        if (data.success) {
            // Redirection ou message de succès
            window.location.href = '../api/verification_code.php'; // Rediriger vers une page de succès
        } else {
            // Afficher l'erreur d'email
            emailError.textContent = data.message;
            emailError.style.display = 'block';
        }
        console.log(data.message);
    })
    .catch(error => {
        // Masquer le message de chargement en cas d'erreur
        loadingMessage.style.display = 'none';
        console.error('Erreur:', error);
    });
});