<?php
function validateUserName($username) {
    require_once "../bootstrap.php";
    echo json_encode($dbh->validateUsername($username));
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    if(isset($_POST['username'])) {
        validateUserName($_POST['username']);
    }
} else {
echo 'Accesso non consentito.';
}