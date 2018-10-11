<?php

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
