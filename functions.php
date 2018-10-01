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


function date_important($date, $hours) {

    $cur_time = date('d.m.Y H.i.s');
    $cur_time = strtotime($cur_time);

    $task_date = $date . " 00:00:00";
    $task_date = strtotime($task_date);

    $seconds = $hours * 3600;

    if (!$task_date) {
        return false;
    } else if (($task_date - $cur_time) <= $seconds) {
        return true;
    } else {
        return false;
    }
}


?>
