<?php
require_once "bootstrap.php";
$templateParams["titolo"] = "SnapSpark - Home";
if (isUserLoggedIn()) {
    $templateParams["nome"] = "template/lista-post.php";
    $templateParams["posts"] = $dbh->getRandomPosts(10);
} else {
    $templateParams["errore"] = "You need logged in";
}


require_once "template/base.php";
