<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$templateParams["titolo"] = "SnapSpark - Search users";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams["nome"] = "search-users.php";
$templateParams["showNavBar"] = true;

require_once "template/base.php";
