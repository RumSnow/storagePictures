<?php
namespace App\Models;

use Delight\Auth\Status;

class Statuses{
  const NORMAL = Status::NORMAL;      //  0
  const ARCHIVED = Status::ARCHIVED;  //  1
  const BANNED = Status::BANNED;      //  2

  public static function getStatuses(){
    return [
      [
        'id' => self::NORMAL,
        'title' => 'Активный'
      ],
      [
        'id' => self::ARCHIVED,
        'title' => 'В архиве'
      ],
      [
        'id' => self::BANNED,
        'title' => 'Забанен'
      ]
    ];
  }

  public static function getStatus($status){
    switch ($status){
      case 0: return "<button class='btn btn-success'>Активный</button>"; break;
      case 1: return "<button type='button' class='btn btn-secondary'>В архиве</button>"; break;
      case 2: return "<span class='btn btn-danger'>Забанен</span>"; break;}
  }
}