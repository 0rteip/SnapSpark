const newImg = document.createElement("img");
const bs_modal = $('#cropper-modal');
const image = document.getElementById('image');
let cropper, reader, file;

const imgInputHelper = document.getElementById("profile-img");
const imgInputHelperLabel = document.getElementById("profile-img-label");
const imgContainer = document.querySelector(".image-container");

bs_modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
    });

}).on('hidden.bs.modal', function () {
    cropper.destroy();
    cropper = null;
});

$("#crop").click(function () {
    const canvas = cropper.getCroppedCanvas({
        width: 160,
        height: 160,
    });

    canvas.toBlob(function (blob) {


        let file = new File([blob], "fileName.jpg", {
            type: "image/jpeg"
        })

        const formData = new FormData();
        formData.append("action", "upload");
        formData.append("upfile", file);
        formData.append("filename", imgInputHelper.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/profile.php", true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // Gestisci la risposta dal server se necessario
                const response = JSON.parse(this.responseText);
                if (response.success) {
                    bs_modal.modal('hide');
                    newImg.src = URL.createObjectURL(file);
                    imgContainer.insertBefore(newImg, imgInputHelperLabel);
                    imgInputHelperLabel.style.display = "none";
                    newImg.addEventListener("click", () => {
                        imgInputHelperLabel.click();
                    });
                }
            }
        };

        xhr.send(formData);
    });
});

// newImg.setAttribute("data-bs-toggle", "tooltip");
// newImg.setAttribute("data-bs-title", "Click to change image");
// new bootstrap.Tooltip(newImg);

// const tooltipTriggerLis = document.querySelectorAll('[data-bs-toggle="tooltip"]')
// const tooltipLis = [...tooltipTriggerLis].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

// document.getElementById('profile-img').addEventListener('focusin', function () {
//     document.getElementById('profile-img-label').style.outline = '2px solid #007bff';
// });

// document.getElementById('profile-img').addEventListener('focusout', function () {
//     document.getElementById('profile-img-label').style.outline = ''; // Stile di default quando l'input perde il focus
// });

imgInputHelper.addEventListener("change", event => {
    const files = event.target.files;

    function done(url) {
        image.src = url;
        bs_modal.modal('show');
    };

    if (files && files.length > 0) {
        file = files[0];

        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
        }
    }
});
