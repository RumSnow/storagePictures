<?php
namespace App\Models;

use Intervention\Image\ImageManagerStatic as Image;

class ImageManager{
  public function __construct(){
  }

  public function uploadAvatar($newAvatar, $currentAvatarName = null){
    if (!is_file($newAvatar['tmp_name']) && !is_uploaded_file($newAvatar['tmp_name'])){
      return $currentAvatarName;
    }
    $this->deleteImage('avatarFolder', $currentAvatarName);
    $filename = strtolower(str_random(6)).'.'. pathinfo($newAvatar['name'], PATHINFO_EXTENSION);
    $image = Image::make($newAvatar['tmp_name'])->resize(300, 300);
    $image->save(config('avatarFolder').$filename);
    return $filename;
  }

  public function uploadPicture($picture){
//    dd($picture);
    $pictureName = strtolower(str_random(6).'.'.pathinfo($picture['name'], PATHINFO_EXTENSION));
    $image = Image::make($picture['tmp_name']);
    $image->save(config('uploadsFolder').$pictureName);
    return $pictureName;
  }

  public function deleteImage($path, $currentImageName){
    if($this->checkImageExists($path, $currentImageName)){
//      dd(config($path).$currentImageName);
      unlink(config($path).$currentImageName);
    }
  }

  public function checkImageExists($path, $currentImageName){
    if ($currentImageName != null && is_file(config($path).$currentImageName) && file_exists(config($path).$currentImageName)){
//      dd('il');
      return true;
    }
  }

  public function getDimension($path, $imageName){
    if ($this->checkImageExists($path, $imageName)){
      list($width, $height) = getimagesize(config($path).$imageName);
      return $width.'x'.$height;
    }
  }

  public function getImage($path, $imageName){
    if ($this->checkImageExists($path, $imageName)){
      return "/".config($path).$imageName;
    } else {
    return '/img/no-avatar.jpg';
    }
  }

}