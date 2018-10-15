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
        $task = $_POST;

        $required = ['name', 'project'];

        $dict = ['name' => '', 'project' => '', 'date' => '', 'preview' => ''];

        $errors = [];

        foreach ($required as $key) {
            if (empty($_POST[$key])) {
                $errors[$key] = 'Это поле надо заполнить';
            }
        }

        $proj_id = 'NULL';

        if(isset($task['project'])) {
            $proj_id = $task['project'];
            $pid_exists = validate_project_id($projects, $proj_id);

            if(!$pid_exists) {
                $errors['project'] = 'Проект не существует';
            }
        }

        $date = $task['date'];

        if(($date != '') && validate_date($date)) {

            $mysqlDate = "'".date('Y-m-d', strtotime($date))."'";
        } elseif(($date != '') && !validate_date($date)) {
            $errors['date'] = 'Дата введена в неверном формате';
        } else {
            $mysqlDate = 'NULL';
        }

        if ($_FILES['preview']['size'] > 0) {

            $tmp_name = $_FILES['preview']['tmp_name'];
            $file = $_FILES['preview']['name'];
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            if($ext) {
                $file_uniq = uniqid().".".$ext;
            } else {
                $file_uniq = uniqid();
            }

            move_uploaded_file($tmp_name, 'uploads/' . $file_uniq);
            $file_uniq = "'".$file_uniq."'";
        } else {
            $file_uniq = 'NULL';
        }

        if (count($errors)) {

            foreach ($dict as $key => $value) {
                if(isset($_POST[$key])) {
                    $dict[$key] = $_POST[$key];
                }
            }

            $content = include_template('add.php',
                ['projects' => $projects, 'errors' => $errors, 'dict' => $dict]);

        } else {

            $task_name = $task['name'];

            if($result = db_add_task($link, $user_id, $proj_id, $task_name, $mysqlDate, $file_uniq)) {
                header('location: /index.php');
                die();

            } else {
                $error = db_get_last_error($link);
                show_error($content, $error);
            }

        }

    } else {

        $content = include_template("add.php", ['projects' => $projects]);
    }

}

render_page($title, $user, $content);
