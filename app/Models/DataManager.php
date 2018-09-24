<?php
namespace App\models;

use Aura\SqlQuery\QueryFactory;
use PDO;

class DataManager{
  private $queryFactory;
  private $pdo;

  public function __construct(PDO $pdo, QueryFactory $queryFactory){
    $this->queryFactory = $queryFactory;
    $this->pdo = $pdo;
  }

  public function create($table, $data){
    $insert = $this->queryFactory->newInsert();
    $insert->into($table)->cols($data);
    $sql = $insert->getStatement();
    $sth = $this->pdo->prepare($sql);
    $sth->execute($insert->getBindValues());
    // get the last insert ID
    $name = $insert->getLastInsertIdName('id');
    return $this->pdo->lastInsertId($name);
  }

  public function delete($table, $id){
    $delete = $this->queryFactory->newDelete();
    $delete->from($table)->where('id = :id')->bindValue('id', $id);
    $sql = $delete->getStatement();
    $sth = $this->pdo->prepare($sql);
    $sth->execute($delete->getBindValues());
    return true;
  }

  public function getAll($table){
    $select = $this->queryFactory->newSelect();
    $select->cols(['*'])->from($table);
    $sql = $select->getStatement();
    $sth = $this->pdo->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function find($table,$id){
    $select = $this->queryFactory->newSelect();
    $select->cols(['*'])
      ->from($table)
      ->where('id = :id')
      ->bindValue('id', $id);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetch(PDO::FETCH_ASSOC);
  }

  public function findAllByCategory($category_id){
    $select = $this->queryFactory->newSelect();
    $select->cols(['*'])
      ->from('photos')
      ->where("$category_id = :id")
      ->bindValue(":id", $category_id);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findAllByUser($user_id){
    $select = $this->queryFactory->newSelect();
    $select->cols(['*'])
      ->from('photos')
      ->where("user_id = :id")
      ->bindValue(":id", $user_id);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getMostPopular($user_id, $limit = null){
    $select = $this->queryFactory->newSelect();
    $select->cols(['*'])
      ->from('photos')
      ->where("user_id = :id")
      ->bindValue(":id", $user_id)
      ->limit($limit)
      ->orderBy(['popular DESC']);
//    dd($select->getStatement());
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function update($table, $id, $data){
//    dd($table, $id, $data);
    $update = $this->queryFactory->newUpdate();
    $update->table($table)
      ->cols($data)
      ->where('id = :id')
      ->bindValue('id', $id);
    $sth = $this->pdo->prepare($update->getStatement());
//    dd($sth, $update->getStatement());

    $sth->execute($update->getBindValues());
  }

  public function getCount($table, $row, $value){
    $select = $this->queryFactory->newSelect();
    $select->from($table)
      ->cols(['*'])
      ->where("$row = :$row")
      ->bindValue($row, $value);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
//    dd($sth->fetchAll(PDO::FETCH_ASSOC));
    return count($sth->fetchAll(PDO::FETCH_ASSOC));
  }

}