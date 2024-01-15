<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$posts = [];

foreach ($dbh->getFollowed($_SESSION["username"]) as $value) {
    $posts += $dbh->getPostsByAuthor($value["username"]);
}

usort($posts, function ($a, $b) {
    // Converte le stringhe datetime in oggetti DateTime per la comparazione
    $dataA = new DateTime($a['data']);
    $dataB = new DateTime($b['data']);

    // Ordina in base alle date in ordine crescente
    return $dataB <=> $dataA;
});


$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams["nome"] = "template/lista-post.php";
$templateParams["posts"] = $posts;
$templateParams["showNavBar"] = true;

require_once "template/base.php";
