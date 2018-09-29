<?php

require_once("functions.php");

require_once("data.php");

$content = include_template("index.php",
        [
            'show_complete_tasks' => $show_complete_tasks,
            'projects' => $projects,
            'tasks' => $tasks
        ]);

$page = include_template("layout.php", ['title' => $title, 'user' => $user, 'content' => $content]);

print($page);

?>
