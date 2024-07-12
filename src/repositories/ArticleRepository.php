<?php

namespace Repositories;

use Entities\Article;
use PDO;

class ArticleRepository extends BaseRepository
{
  public function getLastPublishedArticles($qty)
  {
    $qty = (int)$qty;
    $sql = "SELECT * FROM article ORDER BY published_at DESC LIMIT $qty;";
    $queryResponse = $this->preparedQuery($sql);
    $result = $queryResponse->statement->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);

    return array_map(fn ($data) => new Article($data), $result);
  }
}