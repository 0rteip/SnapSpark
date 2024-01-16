<?php
function getFollowed() {
    require_once '../bootstrap.php';

    $username = $_POST['username'];

    if ($_POST["follow"] === "Follow") {
        $dbh->followUser($_SESSION['username'], $username);
    } else {
        $dbh->unfollowUser($_SESSION['username'], $username);
    }

    echo json_encode(array("followers_number" => count($dbh->getFollower($username))));
    // $result = array();
    // foreach ($array as $follow) :
    //     array_push($result, $follow["username"]);
    // endforeach;
    // echo json_encode(array('followed' => $result));
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Chiamata Ajax rilevata, esegui la funzione
    getFollowed();
} else {
    echo 'Accesso non consentito.';
}
