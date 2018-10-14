<?php

require_once("init.php");
require_once("db_functions.php");

$errors = [];

$user = [];

$content = include_template("guest.php", ['errors' => $errors]);

render_page($title, $user, $content);
