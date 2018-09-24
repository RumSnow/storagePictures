<?php
namespace App\Controllers;

use Delight\Auth\Auth;
use League\Plates\Engine;
use App\models\RegisterManager;
use Tamtamchik\SimpleFlash\BaseTemplate;
use Tamtamchik\SimpleFlash\TemplateInterface;
use Tamtamchik\SimpleFlash\Flash;

class RegisterController extends Controller {
//  private $auth;
//  private $view;
  private $registration;
  private $flash;

  public function __construct(RegisterManager $registration, Flash $flash){
//    $this->auth = $auth;
//    $this->view = $view;
    parent::__construct();
    $this->registration = $registration;
    $this->flash = $flash;
  }

  public function registerForm(){
    echo $this->view->render('auth/registerForm');
  }

  public function register(){
    $this->registration->make(
      $_POST['email'],
      $_POST['password'],
      $_POST['username']
      );
    flash()->success(['На вашу почту ' . $_POST['email'] . ' был отправлен код с подтверждением.']);
//    dd('проверьте почту');
    return header('Location: /loginForm');

  }
}