<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$templateParams['titolo'] = "SnapSpark - Chat";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams['nome'] = 'create-chat.php';
$templateParams['sug'] = getNewChatSug($dbh->getFollowed($_SESSION['username']), $dbh->getChats());
$templateParams["showNavBar"] = true;

require_once "template/base.php";
