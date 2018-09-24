<?php
namespace App\models;

use Aura\SqlQuery\QueryFactory;
use JasonGrimes\Paginator;
use PDO;

class PaginateManager{
  public $page;
  public $perPage;
  private $queryFactory;
  private $pdo;

  public function __construct(QueryFactory $queryFactory, PDO $pdo){
    $this->queryFactory = $queryFactory;
    $this->pdo = $pdo;
    $this->page = isset($_GET['page']) ? $_GET['page'] : 1;
    $this->perPage = 8;
  }

  public function paginate($count, $url){
    return new Paginator($count, $this->perPage, $this->page, $url);
  }

  public function allPaginate($table){
    $select = $this->queryFactory->newSelect();
    $select->cols(['*'])
      ->from($table)
      ->page($this->page)
      ->setPaging($this->perPage);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function customPaginate($table, $row, $id){
    $select = $this->queryFactory->newSelect();
    $select->cols(['*'])
      ->from($table)
      ->where("$row = :$row")
      ->bindValue($row, $id)
      ->page($this->page)
      ->setPaging($this->perPage);
    $sth = $this->pdo->prepare($select->getStatement());
    $sth->execute($select->getBindValues());
    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
}