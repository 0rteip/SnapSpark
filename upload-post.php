<?php
require_once "bootstrap.php";

if ($_SESSION["username"] == null) {
    header("location:login.php");
}

$templateParams["titolo"] = "SnapSpark - Upload";

if (isUserLoggedIn()) {
    $templateParams["nome"] = "template/create-post.php";
    $templateParams["showNavBar"] = true;
} else {
    $templateParams["errore"] = "You need logged in";
}


require_once "template/base.php";
