<?php
require_once ("functions.php");
$db = require_once ("config/db.php");

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if ($link) {
    mysqli_set_charset($link, "utf8");
}


$projects = [];
$content = '';
