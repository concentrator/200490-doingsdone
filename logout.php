<?php

require_once("init.php");

unset($_SESSION['user']);

header('location: /index.php');
die();
