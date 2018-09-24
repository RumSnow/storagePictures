<?php

namespace App\Controllers;

use App\models\DataManager;
use App\Models\ImageManager;
use App\Models\Profile;
use Delight\Auth\Auth;
use Delight\Auth\AuthError;
use League\Plates\Engine;

class ProfileController extends Controller {
//  private $view;
//  private $auth;
//  private $dataManager;
  private $profile;
  private $imageManager;

  public function __construct(Profile $profile, ImageManager $imageManager){
//    $this->view = $view;
//    $this->auth = $auth;
//    $this->dataManager = $dataManager;
    parent::__construct();
    $this->profile = $profile;
    $this->imageManager = $imageManager;
//    checkBanned($this->auth);
  }

  public function showProfile(){
    $user = $this->dataManager->find('users', $this->auth->getUserId());
    $image = $this->imageManager->getImage('avatarFolder', $user['avatar']);
//    dd($image);
    echo $this->view->render('profile/info', [
      'user' => $user,
      'image' => $image
    ]);
  }

  public function changeProfile(){
    try {
      $this->profile->update($_POST['username'], $_POST['email'], $_FILES['avatar']);
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      dd(['неверный формат имейла']);
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
      dd(['А имейл уже существует!']);
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
      dd(['почта не подтверждена']);
    }
    catch (\Delight\Auth\NotLoggedInException $e) {
      dd(['ты не залогинен']);
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      dd(['уоу-уоу, палехче!']);
    }
    return header('Location: /profile');
  }

  public function deleteAvatar(){
    $user = $this->profile->getUser();
    $this->imageManager->deleteImage('avatarFolder', $user['avatar']);
    header('Location: /profile');
//    dd($this->imageManager->deleteImage(, ))
  }

  public function deleteProfile($id){
    $user = $this->dataManager->find('users', $id);
    $this->imageManager->deleteImage('avatarFolder', $user['avatar']);
    try {
      $this->auth->logOut();
    } catch (AuthError $e) {
      dd('logOut не выполнен');
    }
    $this->dataManager->delete('users', $id);
    return header('Location: /');
  }

}