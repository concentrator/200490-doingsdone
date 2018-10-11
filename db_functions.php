<?php

function db_get_last_error($link) {

    $error = mysqli_error($link);
    return $error;
}

function db_get_projects($link, $user_id) {

    $sql = "SELECT `id`, `title` FROM project WHERE user_id = $user_id";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $projects;
    } else {
        return false;
    }
}

function db_get_tasks($link, $user_id) {

    $sql = "SELECT id, title, DATE(deadline) as deadline, is_done, project_id FROM task WHERE user_id = $user_id";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $tasks;
    } else {
        return false;
    }
}

function db_get_tasks_by_proj($link, $user_id, $proj_id) {

    $sql = "SELECT id, title, DATE(deadline) as deadline, is_done, project_id FROM task WHERE user_id = $user_id and project_id = $proj_id";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $tasks;
    } else {
        return false;
    }
}
