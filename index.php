<?php

require_once("functions.php");

$title = "Дела в порядке";

$user = "Константин";

$projects = ["Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];

$tasks = [
    [
        'title'    => 'Собеседование в IT компании',
        'date'     => '01.12.2018',
        'project'  => 'Работа',
        'done'     => false
    ],
    [
        'title'    => 'Выполнить тестовое задание',
        'date'     => '25.12.2018',
        'project'  => 'Работа',
        'done'     => false
    ],
    [
        'title'    => 'Сделать задание первого раздела',
        'date'     => '21.12.2018',
        'project'  => 'Учеба',
        'done'     => true
    ],
    [
        'title'    => 'Встреча с другом',
        'date'     => '22.12.2018',
        'project'  => 'Входящие',
        'done'     => false
    ],
    [
        'title'    => 'Купить корм для кота',
        'date'     => 'нет',
        'project'  => 'Домашние дела',
        'done'     => false
    ],
    [
        'title'    => 'Заказать пиццу',
        'date'     => 'нет',
        'project'  => 'Домашние дела',
        'done'     => false
    ]
];

// var_dump($tasks);

$content = include_template("index.php",
        [
            'show_complete_tasks' => $show_complete_tasks,
            'projects' => $projects,
            'tasks' => $tasks
        ]);

$page = include_template("layout.php", ['title' => $title, 'user' => $user, 'content' => $content]);

print($page);

?>
