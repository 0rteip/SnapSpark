<?php
function getFollowed($user) {
    require_once '../bootstrap.php';
    
}

function followUnfollow($action, $user) {
    require_once '../bootstrap.php';
    if ($action == 'Follow') {
        $dbh->followUser($_SESSION['username'], $user);
    } elseif ($action == 'Unfollow') {
        $dbh->unfollowUser($_SESSION['username'], $user);
    }
    $array = $dbh->getFollowed($_SESSION['username']);
    $result = array();
    foreach ($array as $follow) :
        array_push($result, $follow["username"]);
    endforeach;
    $follower = $dbh->getFollower($user);
    echo json_encode(array('followed' => $result, 'follower' => $follower));
}


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

    if (isset($_POST["action"]) && isset($_POST['follow'])) {
        followUnfollow($_POST["action"], $_POST['follow']);
    } elseif (!isset($_POST["action"]) && isset($_POST['follow'])) {
        followUnfollow("", $_POST['follow']);
    }
} else {
    echo 'Accesso non consentito.';
}
