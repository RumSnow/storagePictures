<?php
namespace App\Controllers;


use App\models\DataManager;
use App\Models\ImageManager;
use App\Models\Notifications;
use Delight\Auth\Auth;
use Delight\Auth\AuthError;
use League\Plates\Engine;

class SecureController extends Controller {
//  private $dataManager;
//  private $auth;
//  private $view;
  private $notifications;


  public function __construct(Notifications $notifications){
//    $this->dataManager = $dataManager;
//    $this->auth = $auth;
//    $this->view = $view;
    parent::__construct();
    $this->notifications = $notifications;
  }

  public function showSecurity(){
    $user = $this->dataManager->find('users', $this->auth->getUserId());
    echo $this->view->render('profile/security', [
      'user' => $user
    ]);
  }

  public function changePassword(){
    try {
      $this->auth->changePassword($_POST['oldPassword'], $_POST['newPassword']);

      dd('password has been changed');
    }
    catch (\Delight\Auth\NotLoggedInException $e) {
      dd('not logged in');
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      dd('invalid password(s)');
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      dd('too many requests');
    }
    catch (AuthError $e) {
      dd("AuthError $e");
    }
    header('Location: /profile/security');
  }

  public function recoveryPasswordForm(){
    echo $this->view->render('profile/recoveryPasswordForm');
  }

  public function recoveryPassword(){
    try {
      $this->auth->forgotPassword($_POST['email'], function ($selector, $token) {
        // send `$selector` and `$token` to the user (e.g. via email)

//        $this->notifications->confirm(urlencode($selector), urlencode($token));
        if ($this->auth->canResetPassword($selector, $token)) {
//        dd('ok');
          echo $this->view->render('profile/newPasswordForm', [
            'selector' => urlencode($selector),
            'token' => urlencode($token),
          ]);
        }
      });

      dd('request has been generated');
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      dd('invalid email address');
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
      dd('email not verified');
    }
    catch (\Delight\Auth\ResetDisabledException $e) {
      dd('password reset is disabled');
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      dd('too many requests');
    }
    catch (AuthError $e) {
      dd("AuthError $e");
    }
  }

  public function setNewPassword(){
    try {
      $this->auth->resetPassword($_POST['selector'], $_POST['token'], $_POST['newPassword']);

      dd('password has been reset');
    }
    catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
      // invalid token
    }
    catch (\Delight\Auth\TokenExpiredException $e) {
      // token expired
    }
    catch (\Delight\Auth\ResetDisabledException $e) {
      // password reset is disabled
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      // invalid password
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      // too many requests
    }
    catch (AuthError $e) {
    }
  }
}