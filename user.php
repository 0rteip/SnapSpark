<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$templateParams["titolo"] = "SnapSpark - Profile";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams["nome"] = "template/user-profile.php";
$username = $_SESSION['username'];

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $templateParams["requireCropper"] = false;
} else {
    $templateParams["requireCropper"] = true;
}

$posts = $dbh->getPostsByAuthor($username);
foreach ($posts as $key => $post) {
    if ($dbh->checkPostLike($_SESSION["username"], $post["id"])) {
        $posts[$key]["liked"] = "true";
    } else {
        $posts[$key]["liked"] = "false";
    }
}

$templateParams["posts"] = $posts;
$templateParams["follower"] = $dbh->getFollower($username);
$templateParams["followed"] = $dbh->getFollowed($username);
$templateParams["info"] = $dbh->getUserInfo($username);

$templateParams["userImage"] = $templateParams["info"]["profile_img"];
$templateParams["username"] = $username;
$templateParams["showNavBar"] = true;

require_once "template/base.php";
