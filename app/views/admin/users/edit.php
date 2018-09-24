<?= $this->layout('admin/layout') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container-fluid">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Админ-панель</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="">
            <div class="box-header">
              <h2 class="box-comment">Изменить пользователя (id = <?= $user['id'] ?>)</h2>
              <div class="box-title">Дата регистрации пользователя: <?= date("d-m-Y", $user['registered']) ?></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <?= flash() ?>
                <form action="/admin/users/update/<?= $user['id'] ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                           value="<?= $user['username'] ?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                           value="<?= $user['email'] ?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Пароль</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1">
                  </div>

                  <div class="form-group">
                    <label>Роль</label>
                    <select class="form-control select2" name="roles_mask" style="width: 50%;">
                      <?php foreach ($roles as $role) : ?>
                        <option <?php if ($user['roles_mask'] == $role['id']) : ?> selected <?php endif; ?>
                            value="<?= $role['id'] ?>"><?= $role['title'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Статус</label>
                    <select class="form-control select2" name="status" style="width: 50%;">
                      <?php foreach ($statuses as $status) : ?>
                        <option <?php if ($user['status'] == $status['id']) : ?> selected <?php endif; ?>
                            value="<?= $status['id'] ?>"><?= $status['title'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <input type="hidden" name="currentAvatarName" value="<?= $user['avatar'] ?>">
                  </div>
                  <div class="form-group">
                    <label class="label"">Аватар</label>
                    <input class="file-input" type="file" name="avatar" ">

                    <br>
                    <img src="/avatar/<?= $user['avatar'] ?>" width="200" alt="">
                  </div>

<!--                  <div class="form-group">-->
<!--                    <div class="checkbox">-->
<!--                      <label>-->
<!--                        <input type="checkbox" name="status">-->
<!--                        Бан-->
<!--                      </label>-->
<!--                    </div>-->
<!--                  </div>-->

                  <div class="form-group">
                    <button class="btn btn-warning">Изменить</button>
                    <a href="/admin/users" class="btn btn-info">Назад</a>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          По вопросам к главному администратору.
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
