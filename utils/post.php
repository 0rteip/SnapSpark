<?php
function likePost() {
    require_once '../bootstrap.php';

    if (isset($_POST["u"]) && isset($_POST["id"])) {
        $dbh->likePost($_POST["u"], $_POST["id"]);
    }
}


function sharePost() {
    require_once '../bootstrap.php';
    require_once '../utils/exception.php';

    try {

        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (
            !isset($_FILES['upfile']['error']) ||
            is_array($_FILES['upfile']['error']) ||
            !isset($_POST['d'])
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

        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
            $finfo->file($_FILES['upfile']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
            throw new FileTypeException('Invalid file format.');
        }

        // Name it uniquely
        $dest_folder = $_SERVER['DOCUMENT_ROOT'] . '/SnapSpark/' . POST_FOLDER . $_FILES['import']['name'];
        $filename = sha1_file($_FILES['upfile']['tmp_name']) . '.' . $ext;

        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            $dest_folder . $filename
        )) {
            throw new FileUploadSuccessException('Failed to move uploaded file.');
        }

        $dbh->sharePost($filename, $_POST["d"]);
        echo 'File is uploaded successfully.';
    } catch (RuntimeException $e) {
        echo $e->getMessage();
    }
}

// Controlla se la richiesta è una chiamata Ajax
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Chiamata Ajax rilevata, esegui la funzione

    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {

            case 'like_post':
                likePost();
                break;
            case 'share_post':
                sharePost();
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
