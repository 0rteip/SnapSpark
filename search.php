<?php
require_once "bootstrap.php";

if ($_SESSION["username"] == null) {
    header("location:login.php");
}
$templateParams['nome'] = 'search-users.php';
require_once "template/base.php";
