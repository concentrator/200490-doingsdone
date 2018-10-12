<?php

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

    $cur_time = strtotime('now');
    $task_time = strtotime($date);

    $seconds = $hours * 3600;

    if($task_time) {
      return (($task_time - $cur_time) <= $seconds);
    }
}
