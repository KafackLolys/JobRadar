//Form image (piece jointe)
document.addEventListener('DOMContentLoaded', (event) => {
    var popup = document.getElementById('container');
    var openBtn = document.getElementById('addimgform');
    var closeBtn = document.getElementById('close_form_img');

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
// Prévisualiser l'image de Form image
document.getElementById('imageUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});
//Form document (piece jointe)
document.addEventListener('DOMContentLoaded', (event) => {
    var popup = document.getElementById('form_doc');
    var openBtn = document.getElementById('adddocform');
    var closeBtn = document.getElementById('close_form_doc');

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

/*_________________________________________________________________________________________*/
//Modifier l'entreprise (nom et description)
document.addEventListener('DOMContentLoaded', (event) => {
    var popup = document.getElementById('form_edit');
    var openBtn = document.getElementById('edit');
    var closeBtn = document.getElementById('close_form');

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
//Form image_entreprise (prophile)
document.addEventListener('DOMContentLoaded', (event) => {
    var popup = document.getElementById('edit_image_entreprise');
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
// Prévisualiser l'image de l'entreprise
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