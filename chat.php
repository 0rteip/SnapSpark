<?php
require_once "bootstrap.php";
$templateParams['titolo'] = "SnapSpark - Chat";

if(isset($_GET['reciver'])) {
    $templateParams['nome'] = 'messages.php';
    $templateParams['reciver'] = $_GET['reciver'];
} else {
    $templateParams['nome'] = 'chat-v.php';
    $templateParams['chats'] = getChats($dbh->getChats());
}



require_once "template/base.php";