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
