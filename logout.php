<?php

require_once("init.php");
require_once("db_functions.php");

$_SESSION['user'] = null;

header('location: /guest.php');
die();
