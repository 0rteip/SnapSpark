<?php
require_once "db/database.php";

$dbh = new DatabaseHelper("localhost", "root", "", "SnapSpark", 3306);
define("POST_FOLDER", "./img/");
define("AVATAR_FOLDER", "./img/avatar/");
