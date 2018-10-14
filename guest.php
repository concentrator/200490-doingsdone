<?php

require_once("init.php");
require_once("db_functions.php");

$errors = [];

$content = include_template("guest.php", ['errors' => $errors]);

render_page($title, $user_name, $content);
