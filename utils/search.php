<?php
function createChat()
{
    require_once '../bootstrap.php';
}
function normalSearch($string, $type)
{
    require_once '../bootstrap.php';
    $result = [];
    if (strlen($string) > 0) {
        $result = searchUsers($string, $dbh->getAllUsers());
    } else if (strlen($string) == 0 && $type == 0) {
        $result = getNewChatSug($dbh->getFollowed($_SESSION['username']), $dbh->getChats());
    }
    echo json_encode(array('users' => $result , 'avatar' => AVATAR_FOLDER, 'currentUser' => $_SESSION['username']));
}

function follow($string, $courrent, $action)
{
    require_once '../bootstrap.php';
    $follow = [];
    if($action === "followed") {
        $follow = $dbh->getFollowed($courrent);
    } else {
        $follow = $dbh->getFollower($courrent);
    }
    if(strlen($string) === 0) {
        echo json_encode(array('users' => $follow , 'avatar' => AVATAR_FOLDER, 'type' => 'l'));
    } else {
        $result = searchUsers($string, $follow);
        echo json_encode(array('users' => $result , 'avatar' => AVATAR_FOLDER, 'type' => 'o'));
    }
}

function searchUsers($string, $users) {
    $result = [];
    foreach ($users as $user) :
        if (strpos($user['username'], $string) !== false) {
            array_push($result, $user);
        }
    endforeach;
    return $result;
}
function searchChat($string, $chats) {
    $result = [];
    foreach ($chats as $chat) :
        if (strpos($chat['user'], $string) !== false) {
            array_push($result, $chat);
        }
    endforeach;
    return $result;
}
function getChat($string) {
    require_once "../bootstrap.php";
    $result = [];
    $chats = getChats($dbh->getChats());
    if (strlen($string) === "") {
        $result = $chats;
    } else {
        $result = searchChat($string, $chats);
    }
    echo json_encode(array('chats' => $result , 'avatar' => AVATAR_FOLDER));
}
function set($name) {
    require_once "utils/functions.php";
    setcourrentUser($name);
    echo $name;
}
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    if(isset($_POST['string'])) {
        if (isset($_POST['type'])) {
            switch($_POST['type']) {
                case 0 : normalSearch($_POST['string'], $_POST['type']);
                    break;
                case 1 : normalSearch($_POST['string'], $_POST['type']);
                    break;
                case 2 : follow($_POST['string'], $_POST['courrent'], $_POST['action']);
                    break;
                case 3 : getChat($_POST['string']);
            }
        }
    }
} else {
    echo 'Accesso non consentito.';
}
