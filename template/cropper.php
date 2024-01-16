<html>

<head>
    <title>How to Crop Image Before Uploading using Cropper Js?</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
</head>
<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
        border-radius: 50%;
    }
</style>

<body>
    <div class="container">
        <h5>Upload Images</h5>
        <form class="custom__form">
            <p>Add image</p>
            <div class="custom__image-container">
                <label id="add-img-label" for="add-single-img">+</label>
                <input type="file" id="add-single-img" accept="image/jpeg" />
            </div>

            <!-- <input type="file" id="image-input" name="photos" accept="image/jpeg" multiple /> -->
            <!-- <br /> -->
            <div class="form__controls">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <!--  default image where we will set the src via jquery-->
                                <img id="image" alt="profile image">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        const newImg = document.createElement("img");
        const bs_modal = $('#modal');
        const image = document.getElementById('image');
        let cropper, reader, file;

        bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });

        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {


                let file = new File([blob], "fileName.jpg", {
                    type: "image/jpeg"
                })

                let formData = new FormData();
                formData.append("action", "upload");
                formData.append("upfile", file);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "../utils/profile.php", true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        // Gestisci la risposta dal server se necessario
                        const response = JSON.parse(this.responseText);
                        if (response.success) {
                            bs_modal.modal('hide');
                            newImg.src = URL.createObjectURL(file);
                            imgContainer.insertBefore(newImg, imgInputHelperLabel);

                            delay
                            alert("success upload image");
                            // window.location.href = "../user.php";
                        }
                    } else {
                        // Gestisci eventuali errori
                        console.error("Errore durante il caricamento.");
                    }
                };

                xhr.send(formData);
            });
        });

        const imgInputHelper = document.getElementById("add-single-img");
        const imgInputHelperLabel = document.getElementById("add-img-label");
        const imgContainer = document.querySelector(".custom__image-container");

        imgInputHelper.addEventListener("change", event => {
            let file = imgInputHelper.files[0];
            if (!file) {
                return;
            }
            // Generate img preview

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
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>
</body>

</html>