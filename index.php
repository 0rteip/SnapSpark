<?php
require_once "bootstrap.php";

$templateparams["titolo"] = "SnapSpark - Home";
$templateparams["nome"] = "template/lista-post.php";
$templateparams["posts"] = $dbh->getRandomPosts(10);

require_once "template/base.php";
