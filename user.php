<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$templateParams["titolo"] = "SnapSpark - Profile";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams["nome"] = "template/user-profile.php";

if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
    $username = $_SESSION['username'];
}

$templateParams["posts"] = $dbh->getPostsByAuthor($username);
$templateParams["follower"] = $dbh->getFollower($username);
$templateParams["followed"] = $dbh->getFollowed($username);
$templateParams["info"] = $dbh->getUserInfo($username);
if ($templateParams["info"]["profile_img"] == "") {
    $templateParams["info"]["profile_img"] = "avatar.png";
}

$templateParams["username"] = $username;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (checkFollow($username, $dbh->getFollowed($_SESSION['username']))) {
        $dbh->followUser($_SESSION['username'], $username);
    } else {
        $dbh->unfollowUser($_SESSION['username'], $username);
    }
}
$templateParams["showNavBar"] = true;


require_once "template/base.php";
