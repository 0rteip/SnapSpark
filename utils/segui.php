<?php
function getFollowed()
{
    require_once '../bootstrap.php';
    $array = $dbh->getFollowed($_SESSION['username']);
    $result = array();
    foreach ($array as $follow):
        array_push($result, $follow["username"]);
    endforeach;
    echo json_encode(array('followed' => $result));
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Chiamata Ajax rilevata, esegui la funzione
    getFollowed();
} else {
    echo 'Accesso non consentito.';
}

