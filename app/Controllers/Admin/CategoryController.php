<?php
namespace App\Controllers\Admin;

use App\models\DataManager;
use Delight\Auth\Auth;
use League\Plates\Engine;
use Respect\Validation\Validator as V;
use Respect\Validation\Exceptions\ValidationException;

class CategoryController{
  private $dataManager;
  private $view;
  private $v;
//  private $auth;

  public function __construct(DataManager $dataManager, Engine $view, V $v, Auth $auth){
    $this->dataManager = $dataManager;
    $this->view = $view;
    $this->v = $v;
//    $this->auth = $auth;
  }

  public function getAll(){
    $categories = $this->dataManager->getAll('categories');
    echo $this->view->render('admin/categories/index', [
      'categories' => $categories
    ]);
  }

  public function create(){
    echo $this->view->render('admin/categories/create');
  }

  public function store(){
    $validator = v::key('title', v::stringType()->notEmpty());
    $this->validate($validator, [
      'title'   =>  'Заполните поле Название'
    ]);
    if ($this->categoryExists($_POST['title'])){
      flash()->error("Категория ".$_POST['title']." уже существует");
      return back();
    };
    $this->dataManager->create('categories', $_POST);
    flash()->success(['Новая категория успешно добавлена']);
    return redirect('/admin/categories');
  }

  public function edit($category_id){
    $category = $this->dataManager->find('categories', $category_id);
    echo $this->view->render('admin/categories/edit', [
      'category' => $category
    ]);
  }

  public function update($category_id){
//    dd($category_id);

    $validator = v::key('title', v::stringType()->notEmpty());
    $this->validate($validator, [
      'title' => 'Заполните поле Название'
    ]);
    if ($this->categoryExists($_POST['title'])){
      flash()->error("Категория ".$_POST['title']." уже существует");
      return back();
    };
    $this->dataManager->update('categories', $category_id, $_POST);
    flash()->success(['Категория "'. $_POST['title'] .'" успешно отредактирована']);
    return redirect('/admin/categories');
  }

  public function delete($category_id){
    $category = $this->dataManager->find('categories', $category_id);
    $this->dataManager->delete('categories', $category_id);
    flash()->success(['Категория "'. $category['title'] .'" была удалена']);
    return back();
  }

  public function validate($validator, $message) {
    try {
      $validator->assert($_POST);

    } catch (ValidationException $exception) {
      $exception->findMessages($message);
      flash()->error($exception->getMessages());
      return back();
    }
  }

  public function categoryExists($newCategory){
    foreach ($this->dataManager->getAll('categories') as $category){
      if ($category['title'] == $newCategory){
        return true;
      }
    }
  }







}






