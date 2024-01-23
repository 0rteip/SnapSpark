const imgInputHelper = document.querySelector("img");
const imgInput = document.getElementById("profile-img");
const bs_modal = $('#cropper-modal');

let cropper, reader, file;

imgInputHelper.addEventListener("click", () => {
    imgInput.click();
});

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

        let formData = new FormData();
        formData.append("action", "change-picture");
        formData.append("upfile", file);
        formData.append("filename", imgInput.value);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/profile.php", true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // Gestisci la risposta dal server se necessario
                const response = JSON.parse(this.responseText);
                if (response.success) {
                    bs_modal.modal('hide');
                    imgInputHelper.src = URL.createObjectURL(file);
                }
            }
        };

        xhr.send(formData);
    });
});

imgInput.addEventListener("change", event => {
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

const modBt = document.getElementById('modifica-bt');
if (modBt !== null) {
    modBt.addEventListener("click", function() {
        location.href = 'modify-create-account.php?action=1'
    })
}
