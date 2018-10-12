<?php

require_once("init.php");
require_once("db_functions.php");

$error = false;

$projects = db_get_projects($link, $user_id);

if ($projects === false) {
    $error = db_get_last_error($link);
    $content = include_template('error.php', ['error' => $error]);
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $task = $_POST;

        $required = ['name', 'date'];
        $dict = ['name' => 'Название', 'date' => 'Дата', 'preview' => 'Файл' ];

        $errors = [];

        foreach ($required as $key) {
            if (empty($_POST[$key])) {
                $errors[$key] = 'Это поле надо заполнить';
            }
        }

        if(isset($task['date'])) {
            $date = $task['date'];
        }

        if (isset($_FILES['preview']['name'])) {
            $tmp_name = $_FILES['preview']['tmp_name'];
            $path = $_FILES['preview']['name'];

        //     $finfo = finfo_open(FILEINFO_MIME_TYPE);
        //     $file_type = finfo_file($finfo, $tmp_name);

            move_uploaded_file($tmp_name, 'uploads/' . $path);
            // $task['path'] = $path;
        }

        if (count($errors)) {
            $content = include_template('add.php',
                ['projects' => $projects, 'errors' => $errors, 'dict' => $dict]);
        } else {

            $proj_id = $task['project'];
            $task_name = $task['name'];

            $result = db_add_tasks($link, $user_id, $proj_id, $task_name, $date, $path);

            header('location: /index.php');
            die();

        }

    } else {

        $content = include_template("add.php", ['projects' => $projects]);
    }
}



$page = include_template("layout.php", ['title' => $title, 'user' => $user, 'content' => $content]);

print($page);
