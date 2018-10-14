<?php

require_once("init.php");

$_SESSION['user'] = null;

header('location: /index.php');
die();
