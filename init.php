<?php
require_once ("functions.php");
$db = require_once ("config/db.php");

$title = "Дела в порядке";

session_start();

if(!$_SESSION['user']) {
    $user = null;
} else {
    $user = $_SESSION['user'];
}

$user_id = 1;

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if ($link) {
    mysqli_set_charset($link, "utf8");
} else {
    $error = mysqli_connect_error();
    show_error($content, $error);
    render_page($title, $user['name'], $content);
    die();
}

// показывать или нет выполненные задачи

$show_complete_tasks = rand(0, 1);

$projects = [];
$content = '';
$proj_id = '';

