<?php

function db_get_last_error($link) {

    $error = mysqli_error($link);
    return $error;
}

function db_get_projects($link, $user_id) {

    $sql = "SELECT p.id, p.title, COUNT(task.project_id) AS task_count FROM project p LEFT JOIN task ON p.id = task.project_id WHERE p.user_id = $user_id GROUP BY p.id";

    $result = mysqli_query($link, $sql);

    if ($result) {
        $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $projects;
    } else {
        return false;
    }
}

function db_get_tasks($link, $user_id) {

    $sql = "SELECT id, title, DATE(deadline) as deadline, is_done, project_id, file FROM task WHERE user_id = $user_id";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $tasks;
    } else {
        return false;
    }
}

function db_get_tasks_by_proj($link, $user_id, $proj_id) {

    $sql = "SELECT id, title, DATE(deadline) as deadline, is_done, project_id, file FROM task WHERE user_id = $user_id and project_id = $proj_id";

    $result = mysqli_query($link, $sql);

    if ($result) {

        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $tasks;

    } else {
        return false;
    }
}

function db_add_task($link, $user_id, $proj_id, $task_name, $date, $file) {

    $task_name = mysqli_real_escape_string($link, $task_name);

    $sql = "INSERT INTO task (created_at, title, deadline, user_id, project_id, file)
            VALUES (CURTIME(), '$task_name', $date, $user_id, $proj_id, $file)";

    $result = mysqli_query($link, $sql);

    return $result;
}
