<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$templateParams['titolo'] = "SnapSpark - Notification";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams['nome'] = 'notification-show.php';
$templateParams["showNavBar"] = true;

require_once "template/base.php";
