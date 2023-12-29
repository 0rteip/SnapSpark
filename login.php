<?php
require_once "bootstrap.php";
session_destroy();
session_start();
$templateParams["titolo"] = "SnapSpark - Home";
if(isset($_POST["mail"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["mail"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    require("index.php");
    exit;
}

else{
    $templateParams["titolo"] = "Blog TW - Login";
    $templateParams["nome"] = "login-form.php";
}

require 'template/base.php';
?>
