<?php

namespace Repositories;

use Entities\Gamme;
use PDO;

class GammeRepository extends BaseRepository
{
  public function getGammeByGammeId($id)
  {
    $queryResponse = $this->preparedQuery("SELECT * FROM gamme WHERE id_gamme = ?", [$id]);
    $data = $queryResponse->statement->fetch(PDO::FETCH_ASSOC);
    if ($data) {
      $gamme = new Gamme($data);
      return $gamme;
    } else {
      return null; // ou false
    }
  }
}
