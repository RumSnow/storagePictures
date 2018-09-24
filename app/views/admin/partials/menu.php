<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>Addd</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
<!--        <img src="--><?//= 'avatar/'.$admin['avatar'] ?><!--" class="img-circle" alt="--><?//= $admin['avatar'] ?><!--">-->
        <img src="<?= '/avatar/'.getProfile()->getAvatar() ?>" class="img-circle" alt="avatar">
      </div>
      <div class="pull-left info">
        <p><?= getProfile()->getUser()['username'] ?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Навигация</li>
      <!-- Optionally, you can add icons to the links -->
      <li><a href="/admin/photos"><i class="fa fa-image"></i> <span>Все изображения</span></a></li>
      <li><a href="/admin/categories"><i class="fa fa-list"></i> <span>Категории</span></a></li>
      <li><a href="/admin/users"><i class="fa fa-group"></i> <span>Пользователи</span></a></li>
      <li><a href="/profile"><i class="fa fa-user-circle"></i> <span>Выйти из админки</span></a></li>
      <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Выйти из системы</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>