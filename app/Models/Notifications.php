<?php
namespace App\Models;

use App\Models;
use Delight\Auth\Auth;
use Delight\Auth\AuthError;

class Notifications{
  private $mail;
  private $auth;

  public function __construct(Mail $mail, Auth $auth){
    $this->mail = $mail;
    $this->auth = $auth;
  }

//  public function verify($email, $selector, $token){
////    dd($email, $selector, $token);
//    $textMessage = "http://storagepictures/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token)";
////    dd($textMessage);
//    $this->mail->send($email, $textMessage);
//  }

  public function verify($selector, $token){
    try {
      $this->auth->confirmEmail(urlencode($selector), urlencode($token));

//      echo ('email address has been verified');
    }
    catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
      dd('invalid token');
    }
    catch (\Delight\Auth\TokenExpiredException $e) {
      dd('token expired');
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
      dd('email address already exists');
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      dd('too many requests');
    }
    catch (AuthError $e) {
      dd("AuthError $e");
    }
  }

  public function confirm($selector, $token){
    try {
      if ($this->auth->canResetPassword($selector, $token)) {
//        dd('ok');
        echo $this->view->render('profile/newPasswordForm', []);
      }
    } catch (AuthError $e) {
      dd('adsf');
    };
  }
}