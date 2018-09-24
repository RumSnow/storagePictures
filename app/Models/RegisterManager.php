<?php
namespace App\Models;

use Delight\Auth\Auth;
use Delight\Auth\AuthError;

//use Tamtamchik\SimpleFlash\Flash;
//use Swift_Message;

class RegisterManager{
  private $auth;
  private $notifications;

  public function __construct(Auth $auth, Notifications $notifications){
    $this->auth = $auth;
    $this->notifications = $notifications;
  }

  public function make($email, $password, $username){
    try {
//      dd($email, $password, $username);
      $userId = $this->auth->register($email, $password, $username, function ($selector, $token){
        // send `$selector` and `$token` to the user (e.g. via email)
//        dd($selector, $selector);
        $this->notifications->verify($selector, $token);
      });
//      dd($userId);
      return $userId;
      // we have signed up a new user with the ID `$userId`

    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      dd(['Неправильный email']);
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      dd(['Неправильный пароль']);
    }
    catch (\Delight\Auth\UserAlreadyExistsException $e) {
      dd(['Пользователь уже существует']);
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      dd(['Слишком много раз пытаетесь зарегаться']);
    }
//    catch (AuthError $e) {
//      $e->getMessage();
//      echo 'AuthError';
//    }
  }

}