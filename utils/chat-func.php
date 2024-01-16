<?php
function getChats($messages) {
    require '../bootstrap.php';
    $chats = array();
    foreach($messages as $message) :
        $user = "";
        if ($message['sender'] !== $_SESSION['username']) {
            $user = $message['sender'];

        } else if($message['reciver'] !== $_SESSION['username']) {
            $user=$message['reciver'];
        }
        $check = checkPresence($chats, $user);
        $userInfo = $dbh->getUserInfo($user)["profile_img"];
        $newChat = array('user' => $user, 'testo' => $message['testo'], 'data' => $message['data'], 'img' => $userInfo);
        if ($check !== false) {
            unset($chats[$check]);
        }
            array_push($chats, $newChat);
    endforeach;
    return array_reverse($chats);
}
