<?php

function isUserLoggedIn() {
    return !empty($_SESSION["mail"]);
}

function registerLoggedUser($user) {
    $_SESSION["mail"] = $user["mail"];
}
