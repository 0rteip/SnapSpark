<?php
function sendNotification($reciver, $type)
{
    require_once '../bootstrap.php';
    $dbh->sendNotification($_SESSION['username'], $reciver, $type);
    echo "send mes";
}

function getAllNotifications()
{
    require_once '../bootstrap.php';
    $result = [];
    $result = $dbh->getUserNotification();
    echo json_encode(array("notifications" => $result ));
}

function checkNewNotification()
{
    require_once '../bootstrap.php';
    //echo json_encode(array("data" => $dbh->checkNewNotification($_SESSION["last_ver_not"]))) ;
    if ($dbh->checkNewNotification($_SESSION["last_ver_not"])) {
        $_SESSION["last_ver_not"] = date('Y-m-d H:i:s');
        echo "true";
    } else {
        echo "false";
    }
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'send':
                if (isset($_POST['reciver']) && isset($_POST['type'])) {
                    sendNotification($_POST['reciver'], $_POST['type']);
                }
                break;
            case 'get':
                getAllNotifications();
                break;
            case 'check':
                checkNewNotification();
                break;
        }
    }
} else {
    echo 'Accesso non consentito.';
}