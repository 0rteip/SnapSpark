<?php
function sendNotification() {
    require_once '../bootstrap.php';
    if (isset($_POST['reciver']) && isset($_POST['type'])) {
        $reciver = $_POST['reciver'];
        $type = $_POST['type'];
        $dbh->sendNotification($_SESSION['username'], $reciver, $type);
        /*Mail*/
        //$reciverMail = $dbh->getUserInfo($reciver)['mail'];
        //sendEmail($reciverMail, $_SESSION['username'], $type);
    }
}

function deleteNotification($id) {
    require_once '../bootstrap.php';

    $dbh->deleteNotification($id);
}

function deleteAllNotification() {
    require_once '../bootstrap.php';

    $dbh->removeAllNotification();
}

function getAllNotifications() {
    require_once '../bootstrap.php';

    $result = $dbh->getUserNotification();
    if (empty($result)) {
        echo json_encode(array("news" => "false", "notifications" => array()));
    } else {
        echo json_encode(array("news" => "true", "notifications" => $result));
    }
}

function checkNewNotification() {
    require_once '../bootstrap.php';

    $nots = $dbh->checkNewNotification();
    $_SESSION["last_ver_not"] = date('Y-m-d H:i:s');

    if (empty($nots)) {
        echo json_encode(array("news" => "false"));
    } else {
        echo json_encode(array("news" => "true", "notifications" => $nots));
    }
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'send':
                sendNotification();
                break;
            case 'get':
                getAllNotifications();
                break;
            case 'check':
                checkNewNotification();
                break;
            case 'del':
                if (isset($_POST['id'])) {
                    deleteNotification($_POST['id']);
                }
                break;
            case 'delAll':
                deleteAllNotification();
                break;
            default:
                break;
        }
    }
} else {
    echo 'Accesso non consentito.';
}
