<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello Bulma!</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
  <link rel="stylesheet" href="../../../project/css/style.css">
</head>
<body>
<div class="wrapper">
  <section class="hero is-dark">
    <div class="hero-body">
      <div class="container">
        <h2 class="title">
          Восстановление пароля.
        </h2>
        <h3 class="subtitle">
          Письмо НЕ придет вам на почту.
        </h3>
      </div>
    </div>
  </section>
  <div class="container main-content">
    <div class="columns">
      <div class="column"></div>
      <div class="column is-quarter auth-form">
        <form action="/recoveryPassword" method="post">
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

          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link">Отправить</button>
            </div>

            <div class="control">
              <a class="button is-text" href="/">Отмена</a>
            </div>
          </div>
        </form>
        <div class="field">
          <p>Нет аккаунта? <b><a href="../../../project/register.html">Регистрация</a></b></p>
          <p>Не пришло письмо подтверждения? <b><a href="../../../project/email-verification.html">Переотправить</a></b>
          </p>
        </div>
      </div>
      <div class="column"></div>
    </div>
  </div>