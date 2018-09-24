<?= $this->layout('layout', [
    'title' => $category['title'],
    'auth' => $auth
]);
?>

      <section class="hero is-primary">
        <div class="hero-body">
          <div class="container">
            <h1 class="title">
              Категория: <?= mb_strtoupper($category['title']) ?>
            </h1>
            <h3 class="subtitle">
              Колличество фотографий в категории: <?= $count ?>
            </h3>
          </div>
        </div>
      </section>
      <section class="section main-content">
        <div class="container">
          <div class="columns  is-multiline">
            <?php foreach ($photos as $photo): ?>
            <div class="column is-one-quarter">
              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <a href="/show/<?= $photo['id'] ?>">
                      <img src="/uploads/<?= $photo['image'] ?>" alt="Placeholder image">
                    </a>
                  </figure>
                </div>
                <div class="card-content">
                  <div class="media">
                    <div class="media-left">
                    <p class="title is-5"><?= $category['title'] ?></p>
                    <p class="title is-6">by <a href="/user/<?= $photo['user_id'] ?>"><?= getUser($photo['user_id'])['username'] ?></a></p>
                    </div>
                    <div class="media-right">
                      <p  class="is-size-7">Размер: 1280x760</p>
                      <time datetime="2016-1-1" class="is-size-7">Added: <?= date('d.m.Y',$photo['date']) ?></time>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php include 'partials/pagination.php' ?>
        </div>
      </section>