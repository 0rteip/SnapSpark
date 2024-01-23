<?php

use function PHPSTORM_META\type;

function validate($action, $value, $type) {
    require_once "../bootstrap.php";
    $check = false;
    if ($action == 'user') {
        if ($type == 1 && $value == $_SESSION['username']) {
            $check = true;
        } else {
            $check = $dbh->validateUsername($value);
        }
    } else if ($action == 'mail') {
        if ($type == 1 && $value == $dbh->getUserInfo($_SESSION['username'])['mail']) {
            $check = true;
        } else {
            $check = $dbh->validateMail($value);
        }
    }
    echo json_encode($check);
}

function validateMail($mail) {
    require_once "../bootstrap.php";
    echo json_encode($dbh->validateUsername($username));
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        if (isset($_POST['action']) && isset($_POST['value']) && isset($_POST['type'])) {
            validate($_POST['action'], $_POST['value'], $_POST['type']);
        }
        
} else {
echo 'Accesso non consentito.';
}