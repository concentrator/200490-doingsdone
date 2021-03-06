<?php
error_reporting (E_ALL);
ini_set ('display_errors', 1);

require_once ("functions.php");
require_once("db_functions.php");
$db = require_once ("config/db.php");

$title = "Дела в порядке";

$tpl_data = '';

session_start();

if(!isset($_SESSION['user'])) {
    $user = null;
} else {
    $user = $_SESSION['user'];
    $user_id = $user['id'];
}

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if ($link) {
    mysqli_set_charset($link, "utf8");
} else {
    $error = mysqli_connect_error();
    show_error($content, $error);
    render_page($title, $user['name'], $content);
    die();
}

$show_complete_tasks = 1;
$projects = [];
$content = '';
$proj_id = '';

