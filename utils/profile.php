<?php
function uploadProfileImage() {
    require_once '../bootstrap.php';
    require_once '../utils/exception.php';

    try {
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (
            !isset($_FILES['upfile']['error']) ||
            is_array($_FILES['upfile']['error']) ||
            !isset($_POST["filename"])
        ) {
            throw new InvalidParametersException('Invalid parameters.');
        }

        // Check $_FILES['upfile']['error'] value.
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new FileUploadException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new FileSizeException('Exceeded filesize limit.');
            default:
                throw new UnknownErrorException('Unknown errors.');
        }

        // You should also check filesize here.
        if ($_FILES['upfile']['size'] > 10000000) {
            throw new FileSizeException('Exceeded filesize limit.');
        }

        // Name it uniquely
        $dest_folder = $_SERVER['DOCUMENT_ROOT'] . '/SnapSpark/' . AVATAR_FOLDER;
        $filename = sha1($_POST['filename']) . '.png';

        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            $dest_folder . $filename
        )) {
            throw new FileUploadSuccessException('Failed to move uploaded file.');
        }

        echo json_encode(array("success" => true, "filename" => $filename));
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}


// Controlla se la richiesta è una chiamata Ajax
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Chiamata Ajax rilevata, esegui la funzione

    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case 'upload':
                uploadProfileImage();
                break;

            default:
                break;
        }
    }
} else {
    // Altrimenti gestisci come un normale accesso al file
    // Puoi restituire un messaggio di errore o fare altro
    echo 'Accesso non consentito.';
}
