<?php
function likePost() {
    require_once '../bootstrap.php';

    if (isset($_POST["u"]) && isset($_POST["id"])) {
        $dbh->likePost($_POST["u"], $_POST["id"]);
    }
}

function checkLike() {
    require_once '../bootstrap.php';

    if (isset($_POST["u"]) && isset($_POST["id"])) {
        $likes = $dbh->checkPostLike($_POST["u"], $_POST["id"]);
        print json_encode(array("liked" => $likes));
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
            case 'check_like':
                checkLike();
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
