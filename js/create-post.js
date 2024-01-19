let dropArea = document.getElementById('drop-area');
let fileElem = document.getElementById('fileElem');
let gallery = document.getElementById('gallery');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
    document.body.addEventListener(eventName, preventDefaults, false);
});

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
});

dropArea.addEventListener('drop', handleDrop, false);

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

function highlight(e) {
    dropArea.classList.add('highlight');
}

function unhighlight(e) {
    dropArea.classList.remove('highlight');
}

function handleDrop(e) {
    let dt = e.dataTransfer;
    let files = dt.files;
    handleFiles(files);
}

dropArea.addEventListener('click', () => {
    fileElem.click();
});

fileElem.addEventListener('change', function (e) {
    handleFiles(this.files);
});

function handleFiles(files) {
    document.getElementById('gallery').innerHTML = '';
    previewFile(files[0]);

}

function insertAfter(newNode, existingNode) {
    existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
}

function enableShare() {
    const tarea = document.getElementById("descArea");
    if (tarea.value.length > 0) {
        const btn = document.getElementById("shareButton");
        btn.removeAttribute("disabled");
    }
    else {
        const btn = document.getElementById("shareButton");
        btn.setAttribute("disabled", "");
    }
}

function sharePost() {
    const desc = document.getElementById("descArea");

    if (desc.value.length === 0) {
        alert("Inserisci una descrizione prima di condividere.");
        return;
    }

    let formData = new FormData();
    formData.append("action", "share_post");
    formData.append("d", desc.value);

    // Aggiungi il file al FormData se presente
    let files = document.getElementById("fileElem").files;
    if (files.length > 0) {
        formData.append("upfile", files[0]);
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/post.php", true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                // Gestisci la risposta dal server se necessario
                console.log(this.responseText);

                window.location.href = "user.php";

            } else {
                // Gestisci eventuali errori
                console.error("Errore durante la condivisione del post.");
            }
        }
    };

    xhr.send(formData);
}

function previewFile(file) {
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = function () {
        let img = document.createElement('img');
        img.classList.add('card-img-top');
        img.src = reader.result;
        img.alt = "preview";
        gallery.appendChild(img);

        document.getElementsByClassName('card-body')[0].style.cssText = 'display:none !important';

        const card_footer = document.createElement('div');
        card_footer.classList.add('card-footer');
        card_footer.innerHTML = `
        <div class="container">
            <form aria-label="post form" method="get" action="create-post.php" role="form" class="row align-items-center justify-content-center">
                <label for="descArea" class="form-label visually-hidden">Description</label>

                <div class="col-10 col-sm-10 ps-0">
                    <textarea class="form-control" id="descArea" placeholder="Add a description..." required></textarea>
                </div>
                <button id="shareButton" type="button" value="Submit" class="col-2 col-sm-2 px-2 btn btn-primary" disabled>Share</button>
            </form>
        </div>
        `;
        insertAfter(card_footer, gallery);
        document.getElementById("descArea").addEventListener("keyup", event => enableShare());
        document.getElementById("shareButton").addEventListener("click", event => sharePost());
    }
}
