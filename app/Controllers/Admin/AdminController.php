<?php
namespace App\Controllers\Admin;

use App\models\DataManager;
use Delight\Auth\Auth;
use League\Plates\Engine;

class AdminController{
  private $auth;
  private $view;
  private $dataManager;

  public function __construct(Auth $auth, Engine $view, DataManager $dataManager){
    $this->auth = $auth;
    $this->view = $view;
    $this->dataManager = $dataManager;
    if ($this->auth->getRoles() != 1){
      noUrl();
    };
  }



  public function index(){
    $admin = $this->dataManager->find('users', $this->auth->getUserId());
    echo $this->view->render('admin/dashboard');
  }
}