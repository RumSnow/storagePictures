<?php

use DI\ContainerBuilder;
use Aura\SqlQuery\QueryFactory;
use League\Plates\Engine;
use Delight\Auth\Auth;

use FastRoute\RouteCollector;


$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
  Engine::class => function () {
//    checkBanned();
    return new Engine('../app/views');
  },
  QueryFactory::class => function () {
    return new QueryFactory("mysql");
  },
  PDO::class => function () {
    return new PDO('mysql:host=localhost; dbname=php01', 'root', '');
  },
  Auth::class => function(){
  return new Auth(new PDO('mysql:host=localhost; dbname=php01', 'root', ''));
  },
  Swift_Mailer::class => function() {
    $transport = (new Swift_SmtpTransport(
      config('mail.smtp'),
      config('mail.port'),
      config('mail.encryption')
    ))
      ->setUsername(config('mail.email'))
      ->setPassword(config('mail.password'));
    return new Swift_Mailer($transport);
  },
]);

$container = $containerBuilder->build();


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
  $r->addRoute('GET', '/', ["App\Controllers\HomeController", 'index']);
  $r->addRoute('GET', '/category/{id:\d+}', ["App\Controllers\HomeController", 'category']);
  $r->addRoute('GET', '/user/{id:\d+}', ["App\Controllers\HomeController", 'user']);
  $r->addRoute('GET', '/goBack', ["App\Controllers\HomeController", 'goBack']);

  $r->addRoute('GET', '/registerForm', ["App\Controllers\RegisterController", 'registerForm']);
  $r->addRoute('POST', '/register', ["App\Controllers\RegisterController", 'register']);
  $r->addRoute('GET', '/loginForm', ["App\Controllers\AuthController", 'loginForm']);
  $r->addRoute('POST', '/login', ["App\Controllers\AuthController", 'login']);
  $r->addRoute('GET', '/logout', ["App\Controllers\AuthController", 'logout']);

  $r->addRoute('GET', '/profile', ["App\Controllers\ProfileController", 'showProfile']);
  $r->addRoute('POST', '/profile/changeProfile', ["App\Controllers\ProfileController", 'changeProfile']);
  $r->addRoute('GET', '/profile/deleteAvatar', ["App\Controllers\ProfileController", 'deleteAvatar']);
  $r->addRoute('GET', '/profile/delete/{id:\d+}', ["App\Controllers\ProfileController", 'deleteProfile']);

  $r->addRoute('GET', '/profile/security', ["App\Controllers\SecureController", 'showSecurity']);
  $r->addRoute('POST', '/profile/security', ["App\Controllers\SecureController", 'changePassword']);
  $r->addRoute('GET', '/recoveryPassword', ["App\Controllers\SecureController", 'recoveryPasswordForm']);
  $r->addRoute('POST', '/recoveryPassword', ["App\Controllers\SecureController", 'recoveryPassword']);
  $r->addRoute('GET', '/newPasswordForm', ["App\Controllers\SecureController", 'newPasswordForm']);
  $r->addRoute('POST', '/setNewPassword', ["App\Controllers\SecureController", 'setNewPassword']);

  $r->addRoute('GET', '/show/{id:\d+}', ["App\Controllers\PhotosController", 'show']);
  $r->addRoute('GET', '/photos/{user_id:\d+}', ["App\Controllers\PhotosController", 'photos']);
  $r->addRoute('GET', '/photos/create', ["App\Controllers\PhotosController", 'createForm']);
  $r->addRoute('POST', '/photos/store', ["App\Controllers\PhotosController", 'store']);
  $r->addRoute('GET', '/photos/edit/{photo_id:\d+}', ["App\Controllers\PhotosController", 'edit']);
  $r->addRoute('POST', '/photos/update/{photo_id:\d+}', ["App\Controllers\PhotosController", 'update']);
  $r->addRoute('GET', '/photos/delete/{photo_id:\d+}', ["App\Controllers\PhotosController", 'delete']);
  $r->addRoute('GET', '/download/{photo_id:\d+}', ["App\Controllers\PhotosController", 'download']);

  $r->addGroup('/admin', function (RouteCollector $r) {
    $r->get('', ['App\Controllers\Admin\AdminController', 'index']);

    $r->get('/photos', ['App\Controllers\Admin\PhotosController', 'getAll']);
//    $r->get('/photos/create', ['App\Controllers\PhotosController', 'createForm']);
    $r->get('/photos/edit/{photo_id:\d+}', ['App\Controllers\Admin\PhotosController', 'edit']);
    $r->post('/photos/update/{photo_id:\d+}', ['App\Controllers\Admin\PhotosController', 'update']);
    $r->get('/photos/delete/{photo_id:\d+}', ['App\Controllers\Admin\PhotosController', 'delete']);

    $r->get('/categories', ['App\Controllers\Admin\CategoryController', 'getAll']);
    $r->get('/categories/create', ['App\Controllers\Admin\CategoryController', 'create']);
    $r->post('/categories/store', ['App\Controllers\Admin\CategoryController', 'store']);
    $r->get('/categories/edit/{category_id:\d+}', ['App\Controllers\Admin\CategoryController', 'edit']);
    $r->post('/categories/update/{category_id:\d+}', ['App\Controllers\Admin\CategoryController', 'update']);
    $r->get('/categories/delete/{category_id:\d+}', ['App\Controllers\Admin\CategoryController', 'delete']);

    $r->get('/users', ['App\Controllers\Admin\UsersController', 'getAll']);
    $r->get('/users/edit/{user_id:\d+}', ['App\Controllers\Admin\UsersController', 'edit']);
    $r->post('/users/update/{user_id:\d+}', ['App\Controllers\Admin\UsersController', 'update']);

  });
});



// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:
    noUrl();
    break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    dd('405 Method Not Allowed');
    break;
  case FastRoute\Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
//        dd($handler, $vars);
    $container->call($handler, $vars);
    break;
}