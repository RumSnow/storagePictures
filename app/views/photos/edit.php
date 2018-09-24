<?= $this->layout('layout') ?>
<?php //dd(get_class_methods($image)) ?>

<section class="hero is-warning">
  <div class="hero-body">
    <div class="container">
      <h2 class="title">
        Редактирование картинки!
      </h2>
    </div>
  </div>
</section>
<div class="container main-content">

  <div class="columns">
    <div class="column"></div>
    <div class="column is-quarter auth-form">
      <?= flash(); ?>
      <div class="field">
        <figure class="image">
          <label class="label"></label>
          <img src="<?= $image->getImage('uploadsFolder', $photo['image']) ?>" alt="">
        </figure>
      </div>
      <form action="/photos/update/<?= $photo['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $photo['id'] ?>">
        <div class="field">
          <label class="label">Название</label>
          <div class="control">
            <input class="input" type="text" name="title" value="<?= $photo['title'] ?>">
          </div>
        </div>

        <div class="field">
          <label class="label">Краткое описание</label>
          <div class="control">
            <textarea class="textarea" name="description"><?= $photo['description'] ?></textarea>
          </div>
        </div>

        <div class="field">
          <label class="label">Выберите категорию</label>
          <div class="control">
            <div class="select">
              <select name="category_id">
                <?php foreach ($categories as $category) : ?>
                  <option <?php if ($photo['category_id'] == $category['id']) : ?>
                    selected
                  <?php endif; ?>
                      value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="field is-grouped">
          <div class="control">
            <button class="button is-success is-large">Обновить</button>
          </div>
        </div>
      </form>
    </div>
    <div class="column"></div>
  </div>
</div>
