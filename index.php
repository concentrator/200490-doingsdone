<?php

require_once("init.php");
require_once("db_functions.php");

$error = false;

$projects = db_get_projects($link, $user_id);

if ($projects === false) {
    $error = db_get_last_error($link);
    $content = include_template('error.php', ['error' => $error]);
} else {

    if (isset($_GET['proj_id'])) {
        $proj_id = intval($_GET['proj_id']);

        if(!isset($projects[$proj_id-1]) || !$proj_id) {
            http_response_code(404);
            $content = include_template('error.php', ['error' => 'Категория не найдена']);
        } else {

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
        }

    } else {

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
