<?php

require_once("init.php");

if($user === null) {
    $is_guest = true;
    $content = include_template("guest.php", ['tpl_data' => $tpl_data]);
    $page = include_template("layout.php",
        ['title' => $title, 'user' => $user, 'content' => $content, 'is_guest' => $is_guest]);
    print($page);
    die();
}

$error = false;

$projects = db_get_projects($link, $user_id);

if ($projects === false) {
    $error = db_get_last_error($link);
    show_error($content, $error);
} else {

    if (isset($_GET['show_completed'])) {
        $show_complete_tasks = intval($_GET['show_completed']);

        if(($show_complete_tasks !== 1) && ($show_complete_tasks !== 0)) {
            header('location: /index.php');
            die();
        }
    }

    if (isset($_GET['date'])) {

        $date = intval($_GET['date']);

        $tasks = db_get_tasks_by_date($link, $user_id, $date);
        if (($tasks !== false)) {
            show_tasks($content, $projects, $tasks, $show_complete_tasks);
        } else {
                $error = db_get_last_error($link);
                show_error($content, $error);
        }

    } elseif(isset($_GET['proj_id'])) {

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

    if (isset($_GET['task_id']) && isset($_GET['check']) && !$error) {

        $task_id = intval($_GET['task_id']);

        $check = intval($_GET['check']);

        if(($row = db_check_task($link, $task_id)) && (($check === 1) || ($check === 0))) {

            $result = db_task_done($link, $task_id, $check);

            if(!$result) {
                $error = db_get_last_error($link);
                show_error($content, $error);
            } else {
                header('location: /index.php');
                die();
            }

        } else {
            $error = db_get_last_error($link);
            show_error($content, $error);
        }
    }
}

render_page($title, $user, $content);
