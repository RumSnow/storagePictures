<?php

use App\models\DataManager;
use JasonGrimes\Paginator;
use Delight\Auth\Auth;
use Aura\SqlQuery\QueryFactory;
//use App\Models\ImageManager;

function getCategory($id){
  global $container;
//  $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
  $queryFactory = $container->get(QueryFactory::class);
  $pdo = $container->get('PDO');
  $dataManager = new DataManager($pdo, $queryFactory);
  return $dataManager->find('categories', $id);
}

function getUser($id){
  global $container;
  $queryFactory = $container->get('Aura\SqlQuery\QueryFactory');
  $pdo = $container->get('PDO');
  $dataManager = new DataManager($pdo, $queryFactory);
  return $dataManager->find('users', $id);
}

function getImage($image){
  return '/uploads/'.$image;
}

//function getAvatar($avatar){
//  return '/avatar/'.$avatar;
//}

function getAllCategories(){
  global $container;
  $pdo = $container->get('PDO');
//  dd(QueryFactory::class);
  $queryFactory = $container->get(QueryFactory::class);
  $dataManager = new DataManager($pdo, $queryFactory);
  return $dataManager->getAll('categories');
}

//function auth(){
//  global $container;
////  dd(Auth::class);
////  dd($container->get(Auth::class));
//  return $container->get(Auth::class);
//}

function getAuth(){
  global $container;
  return $container->get(Auth::class);    // Auth::class - статический метод class возвращает название класса
                                          // метод get - возвращает объект класса Auth
}

function getImageManager($path, $imageName){
  return (new \App\Models\ImageManager())->getImage($path, $imageName);
}

function getProfile(){
  global $container;
  return $container->get(\App\Models\Profile::class);
}

function config($value){
  $config = require '../app/config.php';
  return array_get($config, $value);
}

function back(){
  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit;
}

function redirect($path){
  header("Location: $path");
}

function getStatus($status){
  return \App\Models\Statuses::getStatus($status);
}

function getRole($role){
  return \App\Models\Roles::getRole($role);
}

function noUrl(){
  $view = getComponent(\League\Plates\Engine::class);
  echo $view->render('404'); exit;

}

function getComponent($className){
  global $container;
  return $container->get($className);
}

function checkBanned(){
  global $container;
  $auth = $container->get(Auth::class);
//  dd($auth->isBanned());
  if ($auth->isBanned()){
    flash()->error('Вы забанены. Свяжитесь с админом');
    $auth->logOut();
  }
}