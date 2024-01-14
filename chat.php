<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$templateParams['titolo'] = "SnapSpark - Chat";
$templateParams["hashtag"] = $dbh->getDailyHashtag();

if (isset($_GET['reciver'])) {
    $templateParams['nome'] = 'messages.php';
    $templateParams['reciver'] = $_GET['reciver'];
} else {
    $templateParams['nome'] = 'chat-v.php';
    $templateParams['chats'] = getChats($dbh->getChats());
}

$templateParams["showNavBar"] = true;

require_once "template/base.php";
