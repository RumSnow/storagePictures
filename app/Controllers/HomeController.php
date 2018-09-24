<?php

namespace App\Controllers;

use App\models\PaginateManager;
use Delight\Auth\Auth;
use JasonGrimes\Paginator;
use League\Plates\Engine;
use App\models\DataManager;

class HomeController extends Controller{
//  private $view;
//  private $dataManager;
//  private $auth;
  private $photoController;
  private $paginateManager;

  public function __construct(PhotosController $photoController, PaginateManager $paginateManager){
//    $this->view = $view;
//    $this->dataManager = $dataManager;
//    $this->auth = $auth;
    parent::__construct();
    $this->photoController = $photoController;
    $this->paginateManager = $paginateManager;
  }

  public function index(){
    $count = count($this->dataManager->getAll('photos'));
    $photos = $this->paginateManager->allPaginate('photos');
    $paginator = $this->paginateManager->paginate($count, "/?page=(:num)");
    echo $this->view->render('home', [
      'photos' => $photos,
      'paginator' => $paginator,
//      'auth' => $this->auth
    ]);
  }

  public function category($id){
    $count = $this->dataManager->getCount('photos', 'category_id', $id);
    $photos = $this->paginateManager->customPaginate('photos', 'category_id', $id);
    $paginator = $this->paginateManager->paginate($count, "/category/$id?page=(:num)");
    $category = $this->dataManager->find('categories', $id);
    echo $this->view->render('category', [
      'photos' => $photos,
      'category' => $category,
      'paginator' => $paginator,
      'count' => $count,
//      'auth' => $this->auth
    ]);
  }

  public function user($id){
    $photos = $this->dataManager->findAllByUser($id);
    $user = getUser($id);
    $count = $this->dataManager->getCount('photos', 'user_id', $id);
    echo $this->view->render('user', [
      'photos' => $photos,
      'user' => $user,
      'count' => $count
    ]);
  }





}