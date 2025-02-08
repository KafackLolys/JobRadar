function previewImage() {
    var file = document.getElementById('prophile').files[0];
    var preview = document.getElementById('imagePreview');
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display = 'block';
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
