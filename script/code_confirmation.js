document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("codeConfirmationForm").addEventListener("submit", function(event) {
        event.preventDefault();
        validateConfirmationCode();
    });
});

function validateConfirmationCode() {
    const userCode = document.querySelector('input[name="code"]').value;

    fetch('../api/validateCode.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `code=${encodeURIComponent(userCode)}`,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Code validé avec succès.");
                // Rediriger vers la page de succès ou soumettre le formulaire
                window.location.href = "code_confirmation.php";
            } else {
                console.error("Code invalide.");
                showError('Code de confirmation incorrect');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la validation du code:', error);
        });

    return false; // Empêche la soumission du formulaire jusqu'à la validation du code
}

function showError(message) {
    const errorElement = document.getElementById('code-error');
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    } else {
        console.error('Élément d\'erreur introuvable.');
    }
}
