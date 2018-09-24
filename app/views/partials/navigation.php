<div class="wrapper">
  <div class="container">
    <nav class="navbar is-transparent">
      <div class="navbar-brand">
        <a class="navbar-item" href="#">
          <img src="/uploads/logo.jpg" width="50" height="50">
        </a>
        <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>

      <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href="/">
            Главная
          </a>
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link" href="category.html">
              Категории
            </a>
            <div class="navbar-dropdown is-boxed">
              <?php foreach (getAllCategories() as $category): ?>
                <a class="navbar-item" href="/category/<?= $category['id'] ?>">
                  <?= $category['title'] ?>
                </a>
              <?php endforeach;?>
            </div>
          </div>
        </div>

        <div class="navbar-end">
          <div class="navbar-item">
            <div class="field is-grouped">
              <?php if(getAuth()->isLoggedIn()) :?>
                <div class="dropdown is-hoverable">
                  <div class="dropdown-trigger">
                    <button class="button is-primary" aria-haspopup="true" aria-controls="dropdown-menu4">
                      <span>Управление</span>
                      <span class="icon is-small">
                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                      </span>
                    </button>
                  </div>
                  <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                    <div class="dropdown-content">
                      <div class="dropdown-item manager-links">
                        <p class="control">
                          <a class="button" href="/photos/create">
                            <span class="icon"><i class="fas fa-upload"></i></span>
                            <span>Загрузить картинку</span>
                          </a>
                        </p>

                        <p class="control">
                          <a class="button" href="/photos/<?= getAuth()->getUserId() ?>">
                            <span class="icon"><i class="fas fa-image"></i></span>
                            <span>Моя галерея</span>
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="account control">
                  <p>
                    Здравствуйте, <b><?= getAuth()->getUsername()?></b>
                  </p>
                </div>
                <p class="control">
                  <a class="button is-info" href="/profile">
                    <span class="icon"><i class="fas fa-user"></i></span>
                    <span>Профиль</span>
                  </a>
                </p>
                <p class="control">
                  <a class="button is-dark" href="/logout">
                    <span class="icon"><i class="fas fa-window-close"></i></span>
                    <span>Выйти</span>
                  </a>
                </p>
              <?php else: ?>
                <p class="control">
                  <a class="button is-link" href="/loginForm">
                    <span class="icon"><i class="fas fa-user"></i></span>
                    <span>Войти</span>
                  </a>
                </p>
                <p class="control">
                  <a class="button is-primary" href="/registerForm">
                    <span class="icon"><i class="fas fa-address-book"></i></span>
                    <span>Зарегистрироваться</span>
                  </a>
                </p>
              <?php endif;?>

            </div>
          </div>
        </div>
      </div>
  </div>
</div>