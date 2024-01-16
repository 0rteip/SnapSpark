<?php
function getFollowed() {
    require '../bootstrap.php';
    $array = $dbh->getFollowed($_SESSION['username']);
    $result = array();
    foreach ($array as $follow) :
         array_push($result, $follow["username"]);
    endforeach;
    echo json_encode(array('followed' => $result));
}

function followUnfollow($action, $follow) {
    require_once '../bootstrap.php';
    if ($action == 'Follow') {
        $dbh->followUser($_SESSION['username'], $follow);
    } else if($action == 'Unfollow') {
        $dbh->unfollowUser($_SESSION['username'], $follow);
    }
}


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Chiamata Ajax rilevata, esegui la funzione

    if(isset($_POST["action"]) && isset($_POST['follow'])) {
        followUnfollow($_POST["action"], $_POST['follow']);
    }
    getFollowed();
} else {
    echo 'Accesso non consentito.';
}
