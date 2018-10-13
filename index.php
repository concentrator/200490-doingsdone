<?php

require_once("init.php");
require_once("db_functions.php");

$error = false;

$projects = db_get_projects($link, $user_id);

if ($projects === false) {
    $error = db_get_last_error($link);
    show_error($content, $error);
} else {

    if (isset($_GET['proj_id'])) {
        $proj_id = $_GET['proj_id'];

        $pid_exists = validate_project_id($projects, $proj_id);

        if(!$pid_exists || !$proj_id) {
            http_response_code(404);
            show_error($content, 'Проект не найден');
            render_page($title, $user, $content);
            die();
        }

        $tasks = db_get_tasks_by_proj($link, $user_id, $proj_id);

        if (($tasks !== false)) {
            show_tasks($content, $projects, $tasks, $show_complete_tasks);
        } else {
            $error = db_get_last_error($link);
            show_error($content, $error);
        }

    } else {

        $tasks = db_get_tasks($link, $user_id);

        if (($tasks !== false)) {
            show_tasks($content, $projects, $tasks, $show_complete_tasks);
        } else {
            $error = db_get_last_error($link);
            show_error($content, $error);
        }
    }
}

render_page($title, $user, $content);
