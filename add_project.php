<?php

require_once("init.php");

if($user === null) {
    header('location: /auth.php');
    die();
}

$error = false;

$projects = db_get_projects($link, $user_id);

if ($projects === false) {
    $error = db_get_last_error($link);
    show_error($content, $error);
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $project = $_POST;

        $required = ['name'];

        $errors = [];

        foreach ($required as $key) {
            if (empty($_POST[$key])) {
                $errors[$key] = 'Это поле надо заполнить';
            }
        }

        $ptitle_exists = validate_project_title($projects, $project['name']);

        if($ptitle_exists) {
            $errors['name'] = "Проект с таким именем уже есть";
        }

        if (count($errors)) {

            $content = include_template('add_project.php',
                ['projects' => $projects, 'errors' => $errors]);

        } else {

            $project_name = $project['name'];

            if($result = db_add_project($link, $user_id, $project_name)) {
            header('location: /index.php');
            die();

            } else {
                $error = db_get_last_error($link);
                show_error($content, $error);
            }

        }

    } else {
        $content = include_template("add_project.php", ['projects' => $projects]);
    }
}

render_page($title, $user, $content);
