<?php
require_once "bootstrap.php";
$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["nome"] = "user-profile.php";
$username = $_SESSION['username'];

if (isset($_GET['username'])) {
    $username = $_GET['username'];
}
$templateParams["posts"] = $dbh->getPostsByAuthor($username);
$templateParams["follower"] = $dbh->getFollower($username);
$templateParams["followed"] = $dbh->getFollowed($username);
$templateParams["bio"] = $dbh->getUserBio($username);
$templateParams["username"] = $username;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(checkFollow($username, $dbh->getFollowed($_SESSION['username']))) {
        $dbh->followUser($_SESSION['username'], $username);
    } else {
        $dbh->unfollowUser($_SESSION['username'], $username);
    }
}

require_once "template/base.php";
