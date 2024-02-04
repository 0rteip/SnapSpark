<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$templateParams["titolo"] = "SnapSpark - Info follower";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams["nome"] = "follow-follower.php";
$templateParams["requireCropper"] = false;
if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
    $username = $_SESSION['username'];
}

$templateParams['username'] = $username;
$templateParams['noUser'] = "noUser";

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'follower':
            $templateParams["users"] = $dbh->getFollower($username);
            break;
        case 'followed':
            $templateParams["users"] = $dbh->getFollowed($username);
            break;
        default:
            $templateParams["users"] = [];
            break;
    }
    $templateParams['action'] = $_GET['action'];
}

if (isset($_POST['search'])) {
    echo $_POST['search'];
    $templateParams['users'] = findUsers($_POST['search'], $templateParams["users"]);
}

$templateParams["showNavBar"] = true;

require_once "template/base.php";
