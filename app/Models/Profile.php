<?php
namespace App\Models;

use Delight\Auth\Auth;
use Delight\Auth\AuthError;
use Intervention\Image\Image;
use League\Plates\Engine;

class Profile{
  private $auth;
  private $dataManager;
  private $view;
  private $imageManager;
  private $notifications;

  public function __construct(Auth $auth, DataManager $dataManager, Engine $view, ImageManager $imageManager, Notifications $notifications){
    $this->auth = $auth;
    $this->dataManager = $dataManager;
    $this->view = $view;
    $this->imageManager = $imageManager;
    $this->notifications = $notifications;
  }

  public function getUser(){
    return $this->dataManager->find('users', $this->auth->getUserId());
  }

  public function update($newUsername = null, $newEmail, $newAvatar){
    if ($this->auth->getEmail() != $newEmail) {
      $this->auth->changeEmail($newEmail, function ($selector, $token) use ($newEmail) {
        $this->notifications->verify($selector, $token);
      });
    }
    $user = $this->dataManager->find('users', $this->auth->getUserId());
    $avatar = $this->imageManager->uploadAvatar($newAvatar, $user['avatar']);

    $this->dataManager->update('users', $this->auth->getUserId(), [
      'username' => isset($newUsername)? $newUsername : $this->auth->getUsername(),
      'avatar' => $avatar
    ]);
  }

  public function getAvatar(){
    $user = $this->dataManager->find('users', $this->auth->getUserId());
    return $user['avatar'];
  }



}