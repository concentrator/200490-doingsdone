<?php

require_once("init.php");
require_once("db_functions.php");

$error = false;

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
} else {

    $projects = db_get_projects($link, $user_id);

    if ($projects === false) {
        $error = db_get_last_error($link);
        $content = include_template('error.php', ['error' => $error]);
    }

    if (isset($_GET['proj_id']) && !$error) {
        $proj_id = $_GET['proj_id'];

        $tasks = db_get_tasks_by_proj($link, $user_id, $proj_id);

        if (($tasks !== false)) {

            $content = include_template("index.php",
            [
                'show_complete_tasks' => $show_complete_tasks,
                'projects' => $projects,
                'tasks' => $tasks
            ]);

        } else {
            $error = db_get_last_error($link);
            $content = include_template('error.php', ['error' => $error]);
        }

    } elseif (!$error) {

        $tasks = db_get_tasks($link, $user_id);

        if (($tasks !== false)) {

            $content = include_template("index.php",
            [
                'show_complete_tasks' => $show_complete_tasks,
                'projects' => $projects,
                'tasks' => $tasks
            ]);

        } else {
            $error = db_get_last_error($link);
            $content = include_template('error.php', ['error' => $error]);
        }

    }

}


$page = include_template("layout.php", ['title' => $title, 'user' => $user, 'content' => $content]);


print($page);

?>

