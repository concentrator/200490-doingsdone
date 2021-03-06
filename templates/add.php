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

  <a class="button button--transparent button--plus content__side-button" href="add_project.php">Добавить проект</a>
</section>

<main class="content__main">
  <h2 class="content__main-heading">Добавление задачи</h2>

  <form class="form"  action="add.php" method="post" enctype="multipart/form-data">
    <div class="form__row">
      <label class="form__label" for="name">Название <sup>*</sup></label>

      <input class="form__input<?=(isset($errors['name'])) ? ' form__input--error' : ''?>" type="text" name="name" id="name" value="<?=(isset($dict['name'])) ? $dict['name'] : ''?>" placeholder="Введите название">
      <?php if(isset($errors['name'])):?>
      <span class="form__message error-message"><?=$errors['name']?></span>
      <?php endif;?>

    </div>

    <div class="form__row">
      <label class="form__label" for="project">Проект</label>

      <select class="form__input form__input--select" name="project" id="project">
        <?php foreach($projects as $project): ?>
        <option value="<?=$project['id']?>"<?=(isset($dict['project']) && intval($project['id'])===intval($dict['project'])) ? ' selected' : ''?>><?=$project['title']?></option>
        <?php endforeach; ?>
      </select>
      <?php if(isset($errors['project'])):?>
      <span class="form__message error-message"><?=$errors['project']?></span>
      <?php endif;?>
    </div>

    <div class="form__row">
      <label class="form__label" for="date">Дата выполнения</label>

      <input class="form__input form__input--date<?=(isset($errors['date'])) ? ' form__input--error' : ''?>" type="text" name="date" id="date" value="<?=(isset($dict['date'])) ? $dict['date'] : ''?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
      <?php if(isset($errors['date'])):?>
      <span class="form__message error-message"><?=$errors['date']?></span>
      <?php endif;?>
    </div>

    <div class="form__row">
      <label class="form__label" for="preview">Файл</label>

      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="preview" id="preview" value="">

        <label class="button button--transparent" for="preview">
          <span>Выберите файл</span>
        </label>
      </div>
    </div>

    <div class="form__row form__row--controls">
      <input class="button" type="submit" name="" value="Добавить">
    </div>
  </form>
</main>
