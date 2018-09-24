<?php
namespace App\Controllers\Admin;

use App\models\DataManager;
use App\Models\ImageManager;
use Delight\Auth\Auth;
use Delight\Auth\Status;
use League\Plates\Engine;
//use Respect\Validation\Validator as V;
use App\Models\Roles;
use App\Models\Statuses;

class UsersController{
  private $auth;
  private $view;
  private $dataManager;
  private $imageManager;

  public function __construct(Auth $auth, Engine $view, DataManager $dataManager, ImageManager $imageManager){
    $this->auth = $auth;
    $this->view = $view;
    $this->dataManager = $dataManager;
    $this->imageManager = $imageManager;
  }

  public function getAll(){
    $users = $this->dataManager->getAll('users');
    echo $this->view->render('admin/users/index', [
      'users' => $users
    ]);
  }

  public function edit($user_id){
    $user = $this->dataManager->find('users', $user_id);
    $roles = Roles::getRoles();
    $statuses = Statuses::getStatuses();
    echo $this->view->render('admin/users/edit', [
      'user' => $user,
      'roles' => $roles,
      'statuses' => $statuses
    ]);
  }

  public function update($user_id){
    $data = [
      'username' => $_POST['username'],
      'email' => $_POST['email'],
//      'status' => isset($_POST['status']) ? Status::BANNED : Status::NORMAL,
      'status' => $_POST['status'],
      'roles_mask' => $_POST['roles_mask']
    ];
    if (!empty($_POST['password'])){
      $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    $data['avatar'] = $this->imageManager->uploadAvatar($_FILES['avatar'], $_POST['currentAvatarName']);
//    dd($_POST, $data);
    $this->dataManager->update('users', $user_id, $data);
    flash()->success(["Информация о пользователе ".$_POST['username']." обновлена"]);
    return redirect("/admin/users");
  }
}