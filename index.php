<?php
require_once "bootstrap.php";

if ($_SESSION["username"] == null) {
    header("location:login.php");
}

$posts = [];

foreach ($dbh->getFollowed($_SESSION["username"]) as $value) {
    $posts += $dbh->getPostsByAuthor($value["user"]);
}

$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["nome"] = "template/lista-post.php";
$templateParams["posts"] = $posts;
$templateParams["showNavBar"] = true;


require_once "template/base.php";
