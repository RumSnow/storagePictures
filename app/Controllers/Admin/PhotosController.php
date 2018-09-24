<?php
namespace App\Controllers\Admin;

use App\models\DataManager;
use App\Models\ImageManager;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class PhotosController{
  private $dataManager;
  private $auth;
  private $view;
  private $v;
  private $imageManager;

  public function __construct(DataManager $dataManager, Auth $auth, Engine $view, V $v, ImageManager $imageManager){
    $this->dataManager = $dataManager;
    $this->auth = $auth;
    $this->view = $view;
    $this->v = $v;
    $this->imageManager = $imageManager;
  }

  public function getAll(){
    $photos = $this->dataManager->getAll('photos');
    echo $this->view->render('admin/photos/index', [
      'photos' => $photos
    ]);
  }

//  public function create(){
//    echo $this->view->render('admin/photos/createForm');
//  }

  public function edit($photo_id){
    $photo = $this->dataManager->find('photos', $photo_id);
    $categories = $this->dataManager->getAll('categories');
    echo $this->view->render('admin/photos/edit', [
      'photo' => $photo,
      'categories' => $categories
    ]);
  }

  public function update($photo_id){
//    dd($_POST);
    $validator = $this->v::key('title', v::stringType()->notEmpty())
      ->key('description', v::stringType()->notEmpty())
      ->key('category_id', v::intVal());
    $this->validate($validator);
    $data = [
      'title' => $_POST['title'],
      'description' => $_POST['description'],
      'category_id' => $_POST['category_id']
    ];
    $this->dataManager->update('photos', $photo_id, $data);
    flash()->success(['Описание картинки успешно обновлено']);
    return back();
  }

  public function delete($photo_id){
    $this->dataManager->delete('photos', $photo_id);
    return back();
  }

  public function validate($validator){
    try{
      $validator->assert(array_merge($_POST, $_FILES));
    }
    catch (ValidationException $exception){
//      dd(get_class_methods($exception));
      $exception->findMessages($this->getMessages());
      flash()->error($exception->getMessages());
      return back();
    }
  }

  public function getMessages(){
    return [
      'title' => 'Название картинки - обязательно!',
      'description' => 'Краткое описание для картинки - обязательно!',
      'category_id' => 'Выберите категорию',
      'image' => 'Неверный формат',
      'picture' => 'Необходимо выбрать картинку'
    ];
  }
}