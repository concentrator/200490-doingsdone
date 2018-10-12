<?php
require_once ("functions.php");
$db = require_once ("config/db.php");

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if ($link) {
    mysqli_set_charset($link, "utf8");
} else {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
    $page = include_template("layout.php", ['title' => $title, 'user' => $user, 'content' => $content]);
    die();
}

$title = "Дела в порядке";

$user = "Константин";

$user_id = 1;

// показывать или нет выполненные задачи

$show_complete_tasks = rand(0, 1);

$projects = [];
$content = '';
$proj_id = '';

