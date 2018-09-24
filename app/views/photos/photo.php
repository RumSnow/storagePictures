<?php //dd($photos) ?>
<?php //dd(getUser(7)) ?>
<?= $this->layout('layout', [
    'title' => 'photos'
]); ?>


<section class="hero is-info">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        <?= $photo['title'] ?>
      </h1>
      <h2 class="subtitle">
        <?= $photo['description'] ?>
      </h2>
    </div>
  </div>
</section>

<div class="container main-content">
  <div class="columns">
    <div class="column"></div>
    <div class="column is-half auth-form">
      <br>
      <div class="card">
        <div class="card-image">
          <figure class="image is-4by3">
            <img src="/uploads/<?= $photo['image'] ?>" alt="">
          </figure>
        </div>
        <div class="card-content">
          <div class="media">
            <div class="media-left">
              <figure class="image is-48x48">
                <img src="/avatar/<?= getUser($photo['user_id'])['avatar'] ?>" alt="">
              </figure>
            </div>
            <p class="title is-4">
              Добавил: <a href="/user/<?= $photo['user_id'] ?>"><?= getUser($photo['user_id'])['username'] ?></a>
            </p>
          </div>

          <div class="content">
            <?= $photo['description'] ?>
            <br>
            <time datetime="2016-1-1" class="is-size-6 is-pulled-left">Добавлено: <?= date('d.m.Y',$photo['date']) ?></time>
            <br>
            <p class="is-size-6 is-pulled-left">Кол-во скачиваний: <?= $photo['popular'] ?></p>
            <a href="/" class="button is-pulled-right">На главную</a>
            <a href="/download/<?= $photo['id'] ?>" class="button is-info is-pulled-right">Скачать</a>
            <div class="is-clearfix"></div>

          </div>

        </div>
      </div>

    </div>
    <div class="column"></div>
  </div>

  <hr>

  <div class="columns">
    <div class="column">
      <h1 class="title">Самые популярные фотографии от <a href="/user/<?= $photo['user_id'] ?>"><?= getUser($photo['user_id'])['username'] ?></a></h1>
    </div>
  </div>

  <div class="columns section">
    <?php foreach ($fourPhotosUser as $photoUser): ?>
    <div class="column is-one-quarter">

      <div class="card">
        <div class="card-image">
          <figure class="image is-4by3">
            <a href="/show/<?= $photoUser['id'] ?>">
              <img src="/uploads/<?= $photoUser['image'] ?>" alt="Placeholder image">
            </a>
          </figure>
        </div>
        <div class="card-content">
          <div class="media">
            <div class="media-left">
              <p class="title is-5">
                <a href="/category/<?= $photoUser['category_id'] ?>">
                  <?= getCategory($photoUser['category_id'])['title'] ?>
                </a>
              </p>
            </div>
            <div class="media-right">
              <p class="is-size-7">Размер: 1280x760</p>
              <time datetime="2016-1-1" class="is-size-7">Добавлено: <?= date('d.m.Y',$photo['date']) ?></time>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php endforeach; ?>


  </div>
</div>

