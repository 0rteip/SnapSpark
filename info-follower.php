<?php
require_once "bootstrap.php";

$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["nome"] = "follow-follower.php";
if(isset($_GET['username'])) {
    $username = $_GET['username'];
    $templateParams['noUser'] = "noUser";
    $templateParams["follower"] = $dbh->getFollower($username);
    $templateParams["follow"] = $dbh->getFollowed($username);
    if(isset($_GET['info'])) {
        $templateParams['info'] = $_GET['info'];
    }
}
require_once "template/base.php";