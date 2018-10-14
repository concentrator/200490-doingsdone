<?php

require_once("init.php");
require_once("db_functions.php");

$errors = [];

$dict = ['email' => '', 'name' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST;

    $required = ['email', 'password','name'];

    $errors = [];

    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }

    if(!isset($errors['email'])) {
        $email = $user['email'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'E-mail введён некорректно';
        }

        if(db_check_email($link, $email)) {
            $errors['email'] = 'E-mail уже используется';
        }
    }

    if (count($errors)) {

        foreach ($dict as $key => $value) {
            if(isset($_POST[$key])) {
                $dict[$key] = $_POST[$key];
            }
        }

        $content = include_template('register.php', ['errors' => $errors, 'dict' => $dict]);

    } else {

        $user_name = $user['name'];
        $password = password_hash($user['password'], PASSWORD_DEFAULT);

        if($result = db_register_user($link, $email, $password, $user_name)) {
            header('location: /index.php');
            die();
        } else {
            $error = db_get_last_error($link);
            show_error($content, $error);
        }
    }


} else {
    $content = include_template("register.php", ['errors' => $errors]);
}

render_page($title, $user_name, $content);


