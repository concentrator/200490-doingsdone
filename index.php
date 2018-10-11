<?php

require_once("init.php");
require_once("db_functions.php");

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
} else {

    $projects = db_get_projects($link, $user_id);

    if(!$projects) {
        $error = db_get_last_error($link);
        $content = include_template('error.php', ['error' => $error]);
    }

    $sql = "SELECT id, title, DATE(deadline) as deadline, is_done, project_id FROM task WHERE user_id = $user_id";

    if ($result = mysqli_query($link, $sql)) {
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // передаем в шаблон результат выполнения

        $content = include_template("index.php",
        [
            'show_complete_tasks' => $show_complete_tasks,
            'projects' => $projects,
            'tasks' => $tasks
        ]);
    } else {
        $error = mysqli_error($link);
        $content = include_template('error.php', ['error' => $error]);
    }

    $proj_id = '';

    if (isset($_GET['proj_id'])) {
        $proj_id = $_GET['proj_id'];

        $sql = "SELECT id, title, DATE(deadline) as deadline, is_done, project_id FROM task WHERE user_id = $user_id and project_id = $proj_id";

        if ($result = mysqli_query($link, $sql)) {
            $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // передаем в шаблон результат выполнения

            $content = include_template("index.php",
            [
                'show_complete_tasks' => $show_complete_tasks,
                'projects' => $projects,
                'tasks' => $tasks
            ]);
        } else {
            $error = mysqli_error($link);
            $content = include_template('error.php', ['error' => $error]);
        }
    }

}




// var_dump($projects);

$page = include_template("layout.php", ['title' => $title, 'user' => $user, 'content' => $content]);


print($page);

?>
