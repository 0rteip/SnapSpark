<?php
require_once "bootstrap.php";

if ($_SESSION["username"] == null) {
    header("location:login.php");
}
$templateParams['users'] = [];
if (isset($_POST['search'])) {
    echo $_POST['search'];
    $templateParams['users'] = findUsers($_POST['search'], $dbh->getAllUsers());
}
$templateParams['nome'] = 'search-users.php';
require_once "template/base.php";
