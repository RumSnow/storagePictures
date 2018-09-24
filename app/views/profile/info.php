<?= $this->layout('layout', [
  'title' => $user['username']
]); ?>
<?php
//dd($user)
//?>
<div class="container main-content">
  <div class="columns">
    <div class="column">
      <div class="tabs is-centered pt-100">
        <ul>
          <li class="is-active">
            <a href="/profile">
              <span class="icon is-small"><i class="fas fa-user"></i></span>
              <span>Основная информация</span>
            </a>
          </li>
          <li>
            <a href="/profile/security">
              <span class="icon is-small"><i class="fas fa-lock"></i></span>
              <span>Безопасность</span>
            </a>
          </li>
        </ul>

      </div>
      <div class="is-clearfix"></div>
      <div class="columns is-centered">

        <div class="column is-half">
          <form action="/profile/changeProfile" method="post" enctype="multipart/form-data">
            <div class="field">
              <label class="label">Ваше имя</label>
              <div class="control has-icons-left has-icons-right">
                <input class="input" type="text" value="<?= $user['username'] ?>" name="username">
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
              </div>
            </div>

            <div class="field">
              <label class="label">Email</label>
              <div class="control has-icons-left has-icons-right">
                <input class="input" type="text" value="<?= $user['email'] ?>" name="email">
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                  </span>
              </div>
            </div>

            <div class="field">
              <label class="label">Аватар</label>
              <?php ?>
              <a href="/profile/deleteAvatar" class="btn btn-primary">Удалить аватарку</a>
              <?php ?>
              <div class="control has-icons-left has-icons-right">
                <img src="<?= $image ?>" alt="<?= $user['avatar'] ?>">
                <input class="input" type="file" name="avatar">
              </div>
            </div>

            <div class="control">
              <button class="button is-link">Обновить</button>
            </div>
            <div class="control">
              <a href="/profile/delete/<?= $user['id'] ?>"
                 onclick="return confirm('Вы действительно хотите удалить свой профиль?');"
                 class="btn btn-primary" role="button">Удалить свой профиль</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
