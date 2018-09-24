<?php
namespace App\Models;

use Delight\Auth\Role;

class Roles{
  const ADMIN = Role::ADMIN;      //  1
  const AUTHOR = Role::AUTHOR;    //  2
  const MANAGER = Role::MANAGER;  //  8192


  public static function getRoles(){
    return [
      [
        'id' => self::ADMIN,
        'title' => 'Администратор'
      ],
      [
        'id' => self::AUTHOR,
        'title' => 'Пользователь'
      ],
      [
        'id' => self::MANAGER,
        'title' => 'Менеджер'
      ]
    ];
  }
  public static function getRole($role){
    switch ($role){
      case 1: return 'Админ';
      case 2: return 'Пользователь';
      case 8192: return 'Менеджер';
    }
  }



}