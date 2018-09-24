<?php
namespace App\Controllers;

use App\models\DataManager;
use App\Models\ImageManager;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;
use Tamtamchik\SimpleFlash\Flash;


class PhotosController extends Controller {
//  private $dataManager;
//  private $view;
//  private $auth;
  private $imageManager;
  private $v;

  public function __construct(DataManager $dataManager, Engine $view, ImageManager $imageManager, Auth $auth, v $v){
//    $this->dataManager = $dataManager;
//    $this->view = $view;
//    $this->auth = $auth;
    parent::__construct();
    $this->imageManager = $imageManager;
    $this->v = $v;
  }



  public function show($id){
    $photo = $this->dataManager->find('photos', $id);
    $fourPhotosUser = $this->dataManager->getMostPopular($photo['user_id'], 4);
//    dd($fourPhotosUser);
    echo $this->view->render('photos/photo', [
      'photo' => $photo,
      'fourPhotosUser' => $fourPhotosUser
    ]);
  }

  public function download($photo_id){
    $photo = $this->dataManager->find('photos', $photo_id);
//    dd(getImage($photo['image']));
    $this->count($photo);
    echo $this->view->render('photos/download', [
      'photo' => $photo
    ]);
  }

  public function count($photo){
    $photo['popular'] += 1;
    $this->dataManager->update('photos', $photo['id'], ['popular' => $photo['popular']]);
  }

  public function photos($user_id){
    if (!$this->auth->isLoggedIn()){
      return header("Location: /");
    }
    $photos = $this->dataManager->findAllByUser($user_id);
    $image = new ImageManager();
//    dd($image->getImage('uploadsFolder', $photos['image']));
    echo $this->view->render('photos/photos', [
      'photos' => $photos,
      'image' => $image
    ]);
  }

  public function createForm(){
    if (!$this->auth->isLoggedIn()){
      flash()->error('Для добавления картинки необходимо зарегаться');
      return header('Location: /registerForm');
    }
    $categories = $this->dataManager->getAll('categories');
    echo $this->view->render('photos/createForm', [
      'categories' => $categories
    ]);
  }

  public function store(){
    $validator = $this->v::key('title', v::stringType()->notEmpty())
      ->key('description', v::stringType()->notEmpty())
      ->key('category_id', v::intVal())
//      ->key('picture', v::image()->notEmpty())
      ->keyNested('picture.tmp_name', v::image());
    $this->validate($validator);
    $pictureName = $this->imageManager->uploadPicture($_FILES['picture']);
    $dimensions = $this->imageManager->getDimension('uploadsFolder', $pictureName);
    $data = [
      'title' => $_POST['title'],
      'description' => $_POST['description'],
      'category_id' => $_POST['category_id'],
      'image' => $pictureName,
      'dimensions' => $dimensions,
      'date' => time(),
      'user_id' => $this->auth->getUserId()
    ];
    $this->dataManager->create('photos', $data);
    flash()->success('Спасибо что пополнили нашу базу');
    return back();
  }

  public function edit($photo_id){
    $photo = $this->dataManager->find('photos', $photo_id);
    if ($photo['user_id'] != $this->auth->getUserId()){
      flash()->error(['нельзя редактировать чужую картинку']);
//      dd('нельзя редактировать чужую картинку');
//      $user_id ;
      return header("Location: /photos/".$this->auth->getUserId()." ");
    }
    $categories = $this->dataManager->getAll('categories');
    echo $this->view->render('photos/edit', [
      'photo' => $photo,
      'categories' => $categories,
      'image' => new ImageManager()
    ]);
  }

  public function update($photo_id){
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
    $photo = $this->dataManager->find('photos', $photo_id);
    if ($this->auth->getUserId() != $photo['user_id']){
      flash()->error(['Можно удалять только свои фотографии']);
      return header("Location: /photos/".$this->auth->getUserId()." ");
    };
    $this->imageManager->deleteImage('uploadsFolder', $photo['image']);
    if ($this->dataManager->delete('photos', $photo_id)){
      flash()->success(['Картинка была удалена']);
    };

    return back();
  }

  public function validate($validator){
//    dd($validator);
//    dd(get_class_methods($validator));
//    dd(array_merge($_POST, $_FILES));
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