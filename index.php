<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$posts = [];

foreach ($dbh->getFollowed($_SESSION["username"]) as $value) {
    $posts += $dbh->getPostsByAuthor($value["username"]);
}

$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams["nome"] = "template/lista-post.php";
$templateParams["posts"] = $posts;
$templateParams["showNavBar"] = true;

require_once "template/base.php";
