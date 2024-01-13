<?php
require_once "bootstrap.php";

$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["nome"] = "follow-follower.php";

$username = $_SESSION['username'];
if(isset($_GET['username'])) {
    $username = $_GET['username'];
}
$templateParams['username'] = $username;
$templateParams['noUser'] = "noUser";
$templateParams["users"] = [];
$templateParams['action'] = "";
if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'follower' : $templateParams["users"] = $dbh->getFollower($username);
            break;
        case 'followed' : $templateParams["users"] = $dbh->getFollowed($username);
            break;
    }
    $templateParams['action'] = $_GET['action'];
}
if (isset($_POST['search'])) {
    echo $_POST['search'];
    $templateParams['users'] = findUsers($_POST['search'], $templateParams["users"]);
}

require_once "template/base.php";