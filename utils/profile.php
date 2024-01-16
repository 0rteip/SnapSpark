<?php
function validateImage() {
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    try {
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
        $vals = [];
        $vals[0] = $_SERVER['DOCUMENT_ROOT'] . '/SnapSpark/' . AVATAR_FOLDER;
        $vals[1] = sha1($_POST['filename']) . '.png';

        return $vals;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function uploadProfileImage() {
    require_once '../bootstrap.php';
    require_once '../utils/exception.php';

    try {
        $vals = validateImage();

        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            $vals[0] . $vals[1]
        )) {
            throw new FileUploadSuccessException('Failed to move uploaded file.');
        }

        echo json_encode(array("success" => true));
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}

function changePicture() {
    require_once '../bootstrap.php';
    require_once '../utils/exception.php';

    try {
        $vals = validateImage();

        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            $vals[0] . $vals[1]
        )) {
            throw new FileUploadSuccessException('Failed to move uploaded file.');
        } else {
            $dbh->updateUserPicture($_SESSION['username'], $vals[1]);
        }

        echo json_encode(array("success" => true));
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
            case "change-picture":
                changePicture();
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
