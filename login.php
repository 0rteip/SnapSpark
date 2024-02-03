<?php
require_once "bootstrap.php";

session_destroy();
session_start();

$templateParams["titolo"] = "SnapSpark - Login";

if (isset($_POST["mail"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogin($_POST["mail"], $_POST["password"]);
    if (empty($login_result)) {
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    } else {
        registerLoggedUser($login_result[0]);
    }
}

if (isUserLoggedIn()) {
    header("location:index.php");
} else {
    $templateParams["titolo"] = "Blog TW - Login";
    $templateParams["nome"] = "login-form.php";
}
$templateParams["showNavBar"] = false;

require 'template/base.php';
