<?php
require_once "bootstrap.php";
$templateParams['titolo'] = "SnapSpark - Chat";
$templateParams['nome'] = 'create-chat.php';
$templateParams['sug'] = getNewChatSug($dbh->getFollowed($_SESSION['username']), $dbh->getChats());

require_once "template/base.php";