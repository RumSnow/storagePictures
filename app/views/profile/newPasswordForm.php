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
        <h1 class="title">
          Восстановление пароля.
        </h1>
        <h2 class="subtitle">
          Введите новый пароль.
        </h2>
      </div>
    </div>
  </section>
  <div class="container main-content">
    <div class="columns">
      <div class="column"></div>
      <div class="column is-quarter auth-form">
        <form action="/setNewPassword" method="post">
          <div class="field">
            <label class="label">Новый пароль</label>
            <div class="control has-icons-left has-icons-right">
              <input name="selector" type="hidden" value="<?= $selector ?>">
              <input name="token" type="hidden" value="<?= $token ?>">
              <input class="input" type="password" name="newPassword">  <!-- is-danger -->
              <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
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
          </div>
        </form>
      </div>
      <div class="column"></div>
    </div>
  </div>
</div>