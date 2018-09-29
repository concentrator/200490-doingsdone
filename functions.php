<?php

// показывать или нет выполненные задачи

$show_complete_tasks = rand(0, 1);

function tasksQty($tasks, $project) {
    $qty = 0;

    foreach ($tasks as $task) {
        if ($task['project'] === $project) {
            $qty++;
        }
    }
    return $qty;
}

function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require($name);

    $result = ob_get_clean();

    return $result;
}

?>
