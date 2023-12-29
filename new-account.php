<?php
require_once "bootstrap.php";

$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["nome"] = "create-user.php";

if (
    isset($_POST["username"]) && isset($_POST["nome"]) && isset($_POST["cognome"])
    && isset($_POST["sesso"]) && isset($_POST["password"]) && isset($_POST["data_nascita"])
    && isset($_POST["mail"]) && isset($_POST["numero"]) && isset($_POST["biografia"])
) {
    echo substr($_POST["sesso"], 0,1);
    $id = $dbh->insertNewUser($_POST["username"], $_POST["nome"], $_POST["cognome"],
        substr($_POST["sesso"], 0,1), $_POST["password"], $_POST["data_nascita"], $_POST["mail"], intval($_POST["numero"]), $_POST["biografia"]);
    echo "registrato";
    if ($id != false) {
        $msg = "Inserimento completato correttamente!";
    } else {
        $msg = "Errore in inserimento!";
    }
    $_SESSION['mail'] = $_POST['mail']; 
}

if (isUserLoggedIn()) {
    header("location:index.php");
}

require_once "template/base.php";
