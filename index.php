<?php
require_once "bootstrap.php";

$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["nome"] = "template/lista-post.php";
$templateParams["posts"] = $dbh->getRandomPosts(10);

require_once "template/base.php";
