<?php
require_once "bootstrap.php";
if (($_GET['action'] == "update_user"  && isset($_SESSION['username'])) ||
    ($_GET['action'] == "create_user" && !isset($_SESSION['username']))
) {
    $templateParams["titolo"] = "SnapSpark - Create User";
    $templateParams["nome"] = "create-user.php";
    $templateParams["showNavBar"] = false;
    $templateParams['combobox'] = array('Maschio', 'Femmina', 'Altro');
    if ($_SESSION['username'] != null) {
        $templateParams['accountInfo'] = $dbh->getUserInfo($_SESSION['username']);
        $templateParams["hashtag"] = $dbh->getDailyHashtag();
    } else {
        $templateParams["accountInfo"] = getEmptyUser();
    }

    if (
        isset($_POST["profile-img"]) && isset($_POST["username"]) && isset($_POST["nome"]) &&
        isset($_POST["cognome"]) && isset($_POST["sesso"]) && isset($_POST["password"]) &&
        isset($_POST["data_nascita"]) && isset($_POST["mail"]) && isset($_POST["numero"]) &&
        isset($_POST["biografia"]) && isset($_GET['action'])
    ) {
        if ($_POST["profile-img"] == "" && $_GET['action'] == "create_user") {
            $img = "avatar.png";
        } elseif ($_POST["profile-img"] != "") {
            $img = sha1("C:\\fakepath\\" . $_POST["profile-img"]) . ".png";
        }
        if ($_GET['action'] == "create_user") {
            $dbh->insertNewUser(
                $img,
                $_POST["username"],
                $_POST["nome"],
                $_POST["cognome"],
                $_POST["sesso"],
                $_POST["password"],
                $_POST["data_nascita"],
                $_POST["mail"],
                intval($_POST["numero"]),
                $_POST["biografia"]
            );
            $_SESSION['username'] = $_POST['username'];
            //sendEmail($_POST['mail'], "", "New");
        } elseif ($_GET['action'] == "update_user") {
            $dbh->updateUser(
                $_SESSION['username'],
                $img,
                $_POST["username"],
                $_POST["nome"],
                $_POST["cognome"],
                $_POST["sesso"],
                $_POST["password"],
                $_POST["data_nascita"],
                $_POST["mail"],
                intval($_POST["numero"]),
                $_POST["biografia"]
            );
            $_SESSION['username'] = $_POST['username'];
        }
        header("location:index.php");
    } else {
        $templateParams["requireCropper"] = true;
    }

    require_once "template/base.php";
} else {
    header("location:index.php");
}
