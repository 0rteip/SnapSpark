<?php
function isUserLoggedIn() {
    return !empty($_SESSION["username"]);
}

function registerLoggedUser($user) {
    $_SESSION["username"] = $user["username"];
}

function addQuotes($text) {
    return "'" . addslashes($text) . "'";
}

function hideSection($action, $class) {
    if ($action !== $class) {
        return 'style="display: none;"';
    }
    return "";
}

function checkRadio($action, $id) {
    if ($action === $id) {
        return 'active';
    }
    return "";
}

function findUsers($string, $users) {
    $result = [];
    foreach ($users as $user) :
        if (strpos($user['username'], $string) !== false) {
            array_push($result, $user);
        }
    endforeach;
    echo count($result);
    return $result;
}
