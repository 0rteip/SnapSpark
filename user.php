<?php
require_once "bootstrap.php";

$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["nome"] = "user-profile.php";
$username = $_SESSION['username'];
if(isset($_GET['username'])) {
    $username = $_GET['username'];
}
$templateParams["posts"] = $dbh->getPostsByAuthor($username);
$templateParams["follower"] = $dbh->getFollower($username);
$templateParams["seguiti"] = $dbh->getSeguiti($username);
$templateParams["username"] = $username;
require_once "template/base.php";