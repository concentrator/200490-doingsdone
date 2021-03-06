<?php

require_once("init.php");

$errors = [];

$dict = ['email' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_check = false;

    $user_auth = $_POST;

    $required = ['email','password'];

    $errors = [];

    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }

    if(!count($errors)) {
        $email = $user_auth['email'];

        if(!db_check_user($link, $email)) {
            $errors['email'] = 'E-mail не зарегистрирован';
        } else {
            $user_check = db_check_user($link, $email);
        }
    }

    if (!count($errors) and $user_check) {
        if (password_verify($user_auth['password'], $user_check['password'])) {
            $_SESSION['user'] = $user_check;
        } else {
            $errors['password'] = 'Неверный пароль';
        }
    }

    if (count($errors)) {

        foreach ($dict as $key => $value) {
            if(isset($_POST[$key])) {
                $dict[$key] = $_POST[$key];
            }
        }

        $content = include_template('auth.php', ['errors' => $errors, 'dict' => $dict]);

    } else {

        header('location: /index.php');
        die();
    }

} else {
    $content = include_template("auth.php", ['errors' => $errors]);
}


render_page($title, $user, $content);
