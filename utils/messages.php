<?php
function findMessages($reciver)
{
    require_once '../bootstrap.php';
    echo json_encode(array('messages' => $dbh->getMessages($_SESSION['username'], $reciver)));
}

function sendMessage($reciver, $message) {
    require_once '../bootstrap.php';
    $dbh->sendMessage($_SESSION['username'], $reciver, $message);
}
function deleteMessage($id) {
    require_once '../bootstrap.php';
    $dbh->deleteMessage($id);
}


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    if(isset($_POST['action'])) {
        if ($_POST['action'] == "delete") {
            if(isset($_POST['id'])) {
                deleteMessage($_POST['id']);
            }
        }
        findMessages($_POST['reciver']);
    } else {
        if (isset($_POST['message'])) {
            sendMessage($_POST['reciver'], $_POST['message']);
        }
    }
} else {
    echo 'Accesso non consentito.';
}