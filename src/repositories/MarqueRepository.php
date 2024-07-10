<?php

namespace Repositories;

use Entities\Marque;
use PDO;

class MarqueRepository extends BaseRepository
{ 
  public function getMarqueByMarqueId($id) 
  {
    $queryResponse = $this->preparedQuery("SELECT * FROM marque WHERE id_marque = ?", [$id]);
    $data = $queryResponse->statement->fetch(PDO::FETCH_ASSOC);
    if ($data) {
      $marque = new Marque($data);
      return $marque;
    } else {
      return null; // ou false
    }
  }
}