<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php foreach($projects as $project): ?>
            <li class="main-navigation__list-item">
                <a class="main-navigation__list-item-link" href="index.php?proj_id=<?=$project['id']?>"><?=$project['title']?></a>
                <span class="main-navigation__list-item-count"><?=$project['task_count'];?></span>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="add_project.php">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/index.php?date=1" class="tasks-switch__item">Повестка дня</a>
            <a href="/index.php?date=2" class="tasks-switch__item">Завтра</a>
            <a href="/index.php?date=0" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed"
                   <?php if ($show_complete_tasks): ?>checked<?php endif; ?>
                   type="checkbox">
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php foreach ($tasks as $task): ?>
            <?php if ($show_complete_tasks || !$task['is_done']):?>
            <tr class="tasks__item task<?=($task['is_done']) ? ' task--completed' : ''?><?=(date_important($task['deadline'], 24 )) ? ' task--important' : ''?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="<?=$task['id'];?>" <?=($task['is_done']) ? ' checked' : ''?>>
                        <span class="checkbox__text"><?=strip_tags($task['title']);?></span>
                    </label>
                </td>
                <td class="task__file">
                <?php if(isset($task['file'])):?>
                <a class="download-link" href="/uploads/<?=$task['file'];?>"><?=$task['file'];?></a>
                <?php endif; ?>
                </td>
                <td class="task__date"><?=$task['deadline'];?></td>
            </tr>
            <?php endif; ?>
        <?php endforeach ;?>
    </table>
</main>
