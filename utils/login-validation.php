<?php
function validate($action, $value) {
    require_once "../bootstrap.php";
    $check = false;
    if ($action == 'user') {
        $check = $dbh->validateUsername($value);
    } else if ($action == 'mail') {
        $check = $dbh->validateMail($value);
    }
    echo json_encode($check);
}

function validateMail($mail) {
    require_once "../bootstrap.php";
    echo json_encode($dbh->validateUsername($username));
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        if (isset($_POST['action']) && isset($_POST['value'])) {
            validate($_POST['action'], $_POST['value']);
        }
        
} else {
echo 'Accesso non consentito.';
}