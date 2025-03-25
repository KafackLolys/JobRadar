
//Form (prophile)
document.addEventListener('DOMContentLoaded', (event) => {
    var popup = document.getElementById('edit_photo_prophile');
    var openBtn = document.getElementById('open_form_image');
    var closeBtn = document.getElementById('close_form_image');

    openBtn.onclick = function() {
        popup.style.display = "flex";
    }

    closeBtn.onclick = function() {
        popup.style.display = "none";
    }
    /*
    window.onclick = function (event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    }*/
});
// Prévisualiser l'image
document.getElementById('prophile').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('prophilePreview');
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});