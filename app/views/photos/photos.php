<?= $this->layout('layout') ?>

      <section class="hero is-primary">
        <div class="hero-body">
          <div class="container">
            <h1 class="title">
              Моя галерея
            </h1>
            <h2 class="subtitle">
              То есть - мои картинки
            </h2>
          </div>
        </div>
      </section>
      <section class="section main-content">

        <div class="container">
          <?= flash() ?>
          <div class="columns  is-multiline">
            <?php foreach ($photos as $photo) : ?>
            <div class="column is-one-quarter">

              <div class="card">
                <div class="card-image">
                  <figure class="image is-4by3">
                    <a href="#">
                      <img src="<?= $image->getImage('uploadsFolder', $photo['image']) ?>" alt="Placeholder image">
                    </a>
                  </figure>
                </div>
                <div class="card-content">
                  <div class="media my-photo">
                    <div class="media-left">
                      <p class="title is-5">
                        <a href="/photos/edit/<?= $photo['id'] ?>" class="button is-warning">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="/photos/delete/<?= $photo['id'] ?>" onclick="return confirm('A you sure?');" class="button is-danger">
                          <i class="fa fa-times"></i>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>