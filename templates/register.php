<section class="content__side">
  <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>

  <a class="button button--transparent content__side-button" href="auth.php">Войти</a>
</section>

<main class="content__main">
  <h2 class="content__main-heading">Регистрация аккаунта</h2>

  <form class="form" action="register.php" method="post">
    <div class="form__row">
      <label class="form__label" for="email">E-mail <sup>*</sup></label>

      <input class="form__input<?=(isset($errors['email'])) ? ' form__input--error' : ''?>" type="text" name="email" id="email" value="<?=(isset($dict['email'])) ? $dict['email'] : ''?>" placeholder="Введите e-mail" autocomplete="off">

      <?php if(isset($errors['email'])):?>
      <span class="form__message error-message"><?=$errors['email']?></span>
      <?php endif;?>
    </div>

    <div class="form__row">
      <label class="form__label" for="password">Пароль <sup>*</sup></label>

      <input class="form__input<?=(isset($errors['password'])) ? ' form__input--error' : ''?>" type="password" name="password" id="password" value="" placeholder="Введите пароль" autocomplete="off">
      <?php if(isset($errors['password'])):?>
      <span class="form__message error-message"><?=$errors['password']?></span>
      <?php endif;?>
    </div>

    <div class="form__row">
      <label class="form__label" for="name">Имя <sup>*</sup></label>

      <input class="form__input<?=(isset($errors['name'])) ? ' form__input--error' : ''?>" type="text" name="name" id="name" value="<?=(isset($dict['name'])) ? $dict['name'] : ''?>" placeholder="Введите Имя" autocomplete="off">
      <?php if(isset($errors['name'])):?>
      <span class="form__message error-message"><?=$errors['name']?></span>
      <?php endif;?>
    </div>

    <div class="form__row form__row--controls">

    <?php if($errors):?>
        <p class="error-message">Пожалуйста, исправьте ошибки в форме</p>
    <?php endif;?>

      <input class="button" type="submit" name="" value="Зарегистрироваться">
    </div>
  </form>
</main>
