<?php
require_once "bootstrap.php";

$templateParams["titolo"] = "SnapSpark - Create User";
$templateParams["nome"] = "create-user.php";
$templateParams["showNavBar"] = false;
$templateParams["accountInfo"] = getEmptyUser();
if ($_SESSION['username'] != null) {
    $templateParams['accountInfo'] = $dbh->getUserInfo($_SESSION['username']);
}

if (
    isset($_POST["profile-img"]) && isset($_POST["username"]) && isset($_POST["nome"]) &&
    isset($_POST["cognome"]) && isset($_POST["sesso"]) && isset($_POST["password"]) &&
    isset($_POST["data_nascita"]) && isset($_POST["mail"]) && isset($_POST["numero"]) &&
    isset($_POST["biografia"])
) {
    if ($_POST["profile-img"] == "") {
        $img = "avatar.png";
    } else {
        $img = sha1("C:\\fakepath\\" . $_POST["profile-img"]) . ".png";
    }

    $id = $dbh->insertNewUser(
        $img,
        $_POST["username"],
        $_POST["nome"],
        $_POST["cognome"],
        substr($_POST["sesso"], 0, 1),
        $_POST["password"],
        $_POST["data_nascita"],
        $_POST["mail"],
        intval($_POST["numero"]),
        $_POST["biografia"]
    );
    if (!$id) {
        $msg = "Inserimento completato correttamente!";
    } else {
        $msg = "Errore in inserimento!";
    }
    $_SESSION['username'] = $_POST['username'];
    echo "fatto";
} else {
    $templateParams["requireCropper"] = true;
}

if (isUserLoggedIn()) {
    header("location:index.php");
}

require_once "template/base.php";
