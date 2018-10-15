<?php

function show_error(&$content, $error) {
    $content = include_template('error.php', ['error' => $error]);
}

function show_tasks(&$content, $projects, $tasks, $show_complete_tasks) {
    $content = include_template("index.php",
                [
                    'show_complete_tasks' => $show_complete_tasks,
                    'projects' => $projects,
                    'tasks' => $tasks
                ]);
}

function render_page($title, $user, $content) {
    $page = include_template("layout.php", ['title' => $title, 'user' => $user, 'content' => $content]);
    print($page);
}

function validate_project_id($projects, $proj_id) {
    $pid = intval($proj_id);
    $pid_exists = false;

    foreach ($projects as $project) {
        $project_id = intval($project['id']);

        if($project_id === $pid) {
            $pid_exists = true;
            break;
        }
    }
    return $pid_exists;
}

function validate_project_title($projects, $proj_title) {

    $ptitle_exists = false;

    $proj_title = mb_strtolower($proj_title);

    foreach ($projects as $project) {

        if ($proj_title === mb_strtolower($project['title'])) {
            $ptitle_exists = true;
            break;
        }
    }
    return $ptitle_exists;
}

function validate_date($date) {
    $date_valid = false;

    if (preg_match('/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/', $date)) {
        $dateArr = explode(".", $date);

        if(checkdate ($dateArr[1], $dateArr[0], $dateArr[2])) {
            $date_valid = true;
        }
    }
    return $date_valid;
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

    $cur_time = strtotime('now');
    $task_time = strtotime($date);

    $seconds = $hours * 3600;

    if($task_time) {
      return (($task_time - $cur_time) <= $seconds);
    }
}
