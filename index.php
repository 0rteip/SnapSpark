<?php
require_once "bootstrap.php";

if (!isUserLoggedIn()) {
    header("location:login.php");
}

$posts = [];

foreach ($dbh->getFollowed($_SESSION["username"]) as $value) {
    $post_user = $dbh->getPostsByAuthor($value["username"]);
    foreach ($post_user as $key => $post) {
        if ($dbh->checkPostLike($_SESSION["username"], $post["id"])) {
            $post_user[$key]["liked"] = true;
        } else {
            $post_user[$key]["liked"] = false;
        }
    }
    $posts = array_merge($posts, $post_user);
}

usort($posts, function ($a, $b) {
    // Converte le stringhe datetime in oggetti DateTime per la comparazione
    $dataA = new DateTime($a['data']);
    $dataB = new DateTime($b['data']);

    // Ordina in base alle date in ordine crescente
    return $dataB <=> $dataA;
});

$templateParams["userImage"] = $dbh->getUserInfo($_SESSION["username"])["profile_img"];
$templateParams["titolo"] = "SnapSpark - Home";
$templateParams["hashtag"] = $dbh->getDailyHashtag();
$templateParams["nome"] = "template/lista-post.php";
$templateParams["posts"] = $posts;
$templateParams["showNavBar"] = true;

require_once "template/base.php";
