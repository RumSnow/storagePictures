<?php
namespace App\Controllers;

use Delight\Auth\AttemptCancelledException;
use Delight\Auth\Auth;
use Delight\Auth\AuthError;
use League\Plates\Engine;

class AuthController extends Controller {
//  private $view;
//  public $auth;

//  public function __construct(Auth $auth){
//    parent::__construct();
//    $this->auth = $auth;
//  }

  public function loginForm(){
    $this->checkLogged();
    echo $this->view->render('auth/loginForm');
  }

  public function login(){
    try {
      $remember = null;
      if (isset($_POST['remember'])){
        $remember = (int)(60*60*24*365);
      }

      $this->auth->login($_POST['email'], $_POST['password'], $remember);

      $this->checkBanned();
//      dd($this->auth->isBanned());

      header('Location: /');
    }
    catch (\Delight\Auth\InvalidEmailException $e) {
      dd('wrong email address');
    }
    catch (\Delight\Auth\InvalidPasswordException $e) {
      dd('wrong password');
    }
    catch (\Delight\Auth\EmailNotVerifiedException $e) {
      dd('email not verified');
    }
    catch (\Delight\Auth\TooManyRequestsException $e) {
      dd('too many requests');
    }
    catch (AttemptCancelledException $e) {
      dd('too many requests');
    }
    catch (AuthError $e) {
      dd('too many requests');
    }
  }

  public function logout(){
    try {
      $this->auth->logOut();
      header('Location: /');
    }
    catch (AuthError $e) {
    }
  }

  public function checkBanned(){
    if ($this->auth->isBanned()){
      flash()->error('Вы забанены. Свяжитесь с админом');
      $this->logout();
    }
  }

}