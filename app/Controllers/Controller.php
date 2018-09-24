<?php
namespace App\Controllers;

use App\models\DataManager;
use Delight\Auth\Auth;
use League\Plates\Engine;

class Controller {
  public $auth;
  public $view;
  public $dataManager;

  public function __construct(){
    $this->auth = getComponent(Auth::class);
    $this->view = getComponent(Engine::class);
    $this->dataManager = getComponent(DataManager::class);

    checkBanned();
  }

  public function checkLogged(){
    if ($this->auth->isLoggedin()){
      return redirect('/');
    }
  }



}