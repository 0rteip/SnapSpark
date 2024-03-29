<?php
function isUserLoggedIn() {
    return !empty($_SESSION["username"]);
}

function registerLoggedUser($user) {
    $_SESSION["username"] = $user["username"];
    $_SESSION["last_ver_not"] = date('Y-m-d H:i:s');
}

function setcourrentUser($name) {
    $_SESSION["username"] = $name;
}

function checkRadio($action, $id) {
    if ($action === $id) {
        return 'active';
    }
    return "";
}

function findUsers($string, $users) {
    $result = [];
    foreach ($users as $user) :
        if (strpos($user['username'], $string) !== false) {
            array_push($result, $user);
        }
    endforeach;
    return $result;
}

function checkFollow($name, $array) {
    foreach ($array as $user) :
        if ($user['username'] === $name) {
            return false;
        }
    endforeach;
    return true;
}

function getExistingChat($messages) {
    $chats = array();
    foreach ($messages as $message) :
        $user = "";
        if ($message['sender'] !== $_SESSION['username']) {
            $user = $message['sender'];
        } elseif ($message['reciver'] !== $_SESSION['username']) {
            $user = $message['reciver'];
        }
        $check = checkPresence($chats, $user);
        $newChat = array('user' => $user, 'testo' => $message['testo'], 'data' => $message['data']);
        if ($check !== false) {
            unset($chats[$check]);
        }
        array_push($chats, $newChat);
    endforeach;
    return array_reverse($chats);
}

function checkPresence($chats, $user) {
    foreach ($chats as $chat) :
        if ($chat['user'] === $user) {
            return array_search($chat, $chats);
        }
    endforeach;
    return false;
}

function getNewChatSug($follows, $messages) {
    $existingChats = getExistingChat($messages);
    $result = array();
    foreach ($follows as $follow) {
        if (checkPresence($existingChats, $follow['username']) === false) {
            array_push($result, $follow);
        }
    }
    return $result;
}

function getEmptyUser() {
    return array("nome" => "", "cognome"  => "", "username" => "", "sesso" => "", "password" => "", "data_nascita"  => "", "mail"  => "", "numero"  => "",  "biografia" => "", "profile_img" => "");
}
