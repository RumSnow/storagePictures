<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login!</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">


  <form action="/login" method="post" class="form-inline">
  <div class="container main-content">
    <div class="columns">
      <div class="column"></div>
      <div class="column is-quarter auth-form">

        <div class="field">
          <label class="label">Email</label>
          <div class="control has-icons-left has-icons-right">
            <input class="input" type="email" name="email">  <!-- is-danger -->
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
            <!-- <span class="icon is-small is-right">
              <i class="fas fa-exclamation-triangle"></i>
            </span> -->
          </div>
          <!-- <p class="help is-danger">This email is invalid</p> -->
        </div>

        <div class="field">
          <label class="label">Пароль</label>
          <div class="control has-icons-left has-icons-right">
            <input class="input" type="password" name="password">
            <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
                </span>
          </div>
        </div>

        <div class="field">
          <div class="control">
            <label class="checkbox">
              <input type="checkbox" name="remember">
              Запомнить меня
            </label>
          </div>
        </div>

        <div class="field is-grouped">
          <div class="control">
            <button class="button is-link">Войти</button>
          </div>
          <div class="control">
            <a class="button is-text" href="/">Отмена</a>
          </div>
        </div>
        <div class="field">
          <p>Забыли пароль? <b><a href="/recoveryPassword">Восстановление пароля</a></b></p>
          <p>Не пришло письмо подтверждения? <b><a href="email-verification.html">Переотправить</a></b></p>
        </div>
      </div>
      <div class="column"></div>
    </div>
  </div>
  </form>

</div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(function ($el) {
                $el.addEventListener('click', function () {

                    // Get the target from the "data-target" attribute
                    var target = $el.dataset.target;
                    var $target = document.getElementById(target);

                    // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                    $el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }

    });
</script>
</html>