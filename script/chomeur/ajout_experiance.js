function previewImage() {
    var file = document.getElementById('image').files[0];
    var preview = document.getElementById('imagePreview');
    var champ_i = document.getElementById('champ_i');
    var titre_i = document.querySelector('input[name="titre_i"]');
    var description_i = document.querySelector('textarea[name="description_i"]');
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display = 'block';
        champ_i.style.display = 'flex';
        champ_i.style.flexDirection = 'column';
        titre_i.required = true;
        description_i.required = true;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
        champ_i.style.display = 'none';
        titre_i.required = false;
        description_i.required = false;
    }
}

function previewFile() {
    var file = document.getElementById('doc').files[0];
    const fileType = file.type;
    const maxSize = 2 * 1024 * 1024; // Taille maximale de 2 Mo
    let svgData = "";
    var champ_d = document.getElementById('champ_d');
    var titre_d = document.querySelector('input[name="titre_d"]');
    var description_d = document.querySelector('textarea[name="description_d"]');
    var reader = new FileReader();

    if (file && file.size > maxSize) {
        alert('Le fichier est trop volumineux. La taille maximale autorisée est de 2 Mo.');
        document.getElementById("doc").value = ""; // Réinitialiser l'entrée de fichier
        return;
    }

    reader.onloadend = function () {
        if (fileType === "application/pdf") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:blue' /><text x='10' y='50' fill='white'>PDF</text></svg>";
        } else if (fileType === "text/plain") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:green' /><text x='10' y='50' fill='white'>TXT</text></svg>";
        } else if (fileType === "application/msword" || fileType === "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:red' /><text x='10' y='50' fill='white'>DOC</text></svg>";
        } else if (fileType === "application/rtf") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:purple' /><text x='10' y='50' fill='white'>RTF</text></svg>";
        } else if (fileType === "application/vnd.oasis.opendocument.text") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:orange' /><text x='10' y='50' fill='white'>ODT</text></svg>";
        } else if (fileType === "text/html") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:yellow' /><text x='10' y='50' fill='black'>HTML</text></svg>";
        } else if (fileType === "application/xml") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:lightblue' /><text x='10' y='50' fill='black'>XML</text></svg>";
        } else if (fileType === "text/csv") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:lightgreen' /><text x='10' y='50' fill='black'>CSV</text></svg>";
        } else if (fileType === "application/json") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:brown' /><text x='10' y='50' fill='white'>JSON</text></svg>";
        } else if (fileType === "text/markdown") {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:cyan' /><text x='10' y='50' fill='black'>MD</text></svg>";
        } else {
            svgData = "<svg width='100' height='100'><rect width='100' height='100' style='fill:gray' /><text x='10' y='50' fill='white'>AUTRE</text></svg>";
        }
        document.getElementById("image_svg").innerHTML = svgData;
        champ_d.style.display = 'flex';
        champ_d.style.flexDirection = 'column';
        titre_d.required = true;
        description_d.required = true;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        document.getElementById("image_svg").innerHTML = "";
        champ_d.style.display = 'none';
        titre_d.required = false;
        description_d.required = false;
    }
}


