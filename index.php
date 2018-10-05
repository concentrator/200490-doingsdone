<?php

require_once("init.php");

require_once("data.php");

$user_id = 1;

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
} else {
    $sql = "SELECT `id`, `title` FROM project WHERE user_id = $user_id";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
        $content = include_template('error.php', ['error' => $error]);
    }
}


$content = include_template("index.php",
        [
            'show_complete_tasks' => $show_complete_tasks,
            'projects' => $projects,
            'tasks' => $tasks
        ]);

$page = include_template("layout.php", ['title' => $title, 'user' => $user, 'content' => $content]);

print($page);

?>
