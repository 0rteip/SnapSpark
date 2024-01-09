<?php
function getComments() {
    require_once '../bootstrap.php';

    if (isset($_POST["u"]) && isset($_POST["i"])) {

        $response = array('comments' => $dbh->getComments($_POST["u"], $_POST["i"]));
        echo json_encode($response);
    }
}

function postComments() {
    require_once '../bootstrap.php';

    if (isset($_POST["u"]) && isset($_POST["i"]) && isset($_POST["c"])) {
        $dbh->addComment($_POST["u"], $_POST["i"], $_POST["c"]);
        echo json_encode(array('success' => true));
    }
}

function likeComment() {
    require_once '../bootstrap.php';

    if (isset($_POST["cu"]) && isset($_POST["pu"]) && isset($_POST["pid"]) && isset($_POST["cid"])) {
        $dbh->likeComment($_POST["cu"], $_POST["pu"], $_POST["pid"], $_POST["cid"]);
        echo json_encode(array('success' => true));
    }
}

// Controlla se la richiesta è una chiamata Ajax
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Chiamata Ajax rilevata, esegui la funzione

    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case 'get_comments':
                getComments();
                break;
            case 'post_comments':
                postComments();
                break;
            case 'like_comment':
                likeComment();
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
