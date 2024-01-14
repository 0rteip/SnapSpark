<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$templateParams["titolo"] = "SnapSpark - Upload";
$templateParams["hashtag"] = $dbh->getDailyHashtag();


if (isUserLoggedIn()) {
    $templateParams["nome"] = "template/create-post.php";
    $templateParams["showNavBar"] = true;
} else {
    $templateParams["errore"] = "You need logged in";
}


require_once "template/base.php";
