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
    $templateParams["requireCropper"] = true;
}

$templateParams["posts"] = $dbh->getPostsByAuthor($username);
$templateParams["follower"] = $dbh->getFollower($username);
$templateParams["followed"] = $dbh->getFollowed($username);
$templateParams["info"] = $dbh->getUserInfo($username);
if ($templateParams["info"]["profile_img"] == "") {
    $templateParams["info"]["profile_img"] = "avatar.png";
}

$templateParams["userImage"] = $templateParams["info"]["profile_img"];
$templateParams["username"] = $username;
$templateParams["showNavBar"] = true;

require_once "template/base.php";
