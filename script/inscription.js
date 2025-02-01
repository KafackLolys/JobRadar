let currentTab = 0;
document.addEventListener("DOMContentLoaded", () => {
    showTab(currentTab);

    let inputFields = document.querySelectorAll(".champ");
    inputFields.forEach(field => {
        field.addEventListener("focus", () => {
            let labelElement = document.getElementById(field.name + '-label');
            labelElement.textContent = `- ${field.placeholder.toLowerCase()}`;
            labelElement.style.opacity = '1'; // Rend le label visible
        });
        
    });
});


function showTab(n) {
    let tabs = document.querySelectorAll(".tab");
    tabs[n].style.display = "block";
    if (n === 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n === (tabs.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Soumettre";
    } else {
        document.getElementById("nextBtn").innerHTML = "Suivant";
    }
}

function nextPrev(n) {
    let tabs = document.querySelectorAll(".tab");
    if (n === 1 && !validateForm()) return false;
    tabs[currentTab].style.display = "none";
    currentTab += n;

    if (currentTab >= tabs.length) {
        validateConfirmationCode();
    } else {
        showTab(currentTab);
    }
    if (currentTab == 2) { // Étape 3 (index 2)
        sendEmail();
    }
}

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
            document.getElementById("multiStepForm").submit();
        } else {
            console.error("Code invalide.");
            showError('Code de confirmation incorrect');

            // Revenir à l'étape précédente si le code est incorrect
            currentTab -= 1;
            showTab(currentTab);
        }
    })
    .catch(error => {
        console.error('Erreur lors de la validation du code:', error);

        // Revenir à l'étape précédente en cas d'erreur
        currentTab -= 1;
        showTab(currentTab);
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


function sendEmail() {
    const form = document.getElementById('multiStepForm');
    const formData = new FormData(form);
    // Affiche les données du formulaire pour le débogage
    for (let [key, value] of formData.entries()) { 
        console.log(key, value);
    }

    fetch('../api/sendEmail.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())  // Notez que nous utilisons response.text() ici pour afficher la réponse brute
    .then(data => {
        console.log(data);  // Affiche la réponse brute dans la console
        let jsonData;
        try {
            jsonData = JSON.parse(data);  // Tente de parser le JSON
        } catch (error) {
            console.error('Erreur de parsing JSON:', error, data);  // Affiche l'erreur de parsing et la réponse brute
        }
    
        if (jsonData && jsonData.success) {
            console.log(jsonData.message);
        } else if (jsonData) {
            console.error(jsonData.message);
        }
    })
    .catch(error => {
        console.error('Erreur lors de l\'envoi de l\'email:', error);
    });
    
}


function validateForm() {
    let valid = true;
    let currentTabFields = document.querySelectorAll(".tab")[currentTab].querySelectorAll("input");
    currentTabFields.forEach(field => {
        let errorElement = document.getElementById(field.name + '-error');
        errorElement.textContent = ''; // Efface les messages d'erreur précédents
        if (!field.value) {
            field.classList.add("invalid");
            errorElement.textContent = 'Ce champ est requis';
            valid = false;
        } else if (field.type === 'email' && !validateEmail(field.value)) {
            field.classList.add("invalid");
            errorElement.textContent = 'Adresse email invalide';
            valid = false;
        } else if (field.type === 'password' && !validatePassword(field.value)) {
            field.classList.add("invalid");
            errorElement.textContent = 'Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial';
            valid = false;
        } else if (field.name === 'cmdp' && field.value !== document.getElementById('mdp').value) {
            field.classList.add("invalid");
            errorElement.textContent = 'Les mots de passe ne correspondent pas';
            valid = false;
        } else {
            field.classList.remove("invalid");
        }
    });

    // Vérification spécifique pour le champ "sexe"
    let sexeFields = document.querySelectorAll("input[name='sexe']");
    let sexeSelected = Array.from(sexeFields).some(sexe => sexe.checked);
    let sexeErrorElement = document.getElementById('sexe-error');
    if (!sexeSelected) {
        sexeErrorElement.textContent = 'Veuillez sélectionner votre sexe';
        valid = false;
    } else {
        sexeErrorElement.textContent = '';
    }

    return valid;
}

function validateEmail(email) {
    // Expression régulière pour valider l'adresse email
    let re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(email);
}

function validatePassword(password) {
    // Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial
    let re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return re.test(password);
}


