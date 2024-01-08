<?php
require_once "bootstrap.php";

if ($_SESSION["username"] == null) {
    header("location:login.php");
}

$posts = [];

foreach ($dbh->getFollowed($_SESSION["username"]) as $value) {
    $posts += $dbh->getPostsByAuthor($value["username"]);
}

$templateParams["titolo"] = "SnapSpark - Home";
if (isUserLoggedIn()) {
    $templateParams["nome"] = "template/lista-post.php";
    $templateParams["posts"] = $posts;
    $templateParams["showNavBar"] = true;

} else {
    $templateParams["errore"] = "You need logged in";
}


require_once "template/base.php";
