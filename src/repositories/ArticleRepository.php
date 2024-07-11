<?php

namespace Repositories;

use Entities\Article;
use PDO;

class ArticleRepository extends BaseRepository
{
  // public function getAll()
  // {
  //   $queryResponse = $this->preparedQuery("SELECT * FROM article");
  //   $result = $queryResponse->statement->fetchAll(PDO::FETCH_ASSOC);
  //   return array_map(fn($data)=> new Article($data), $result);
  // }

  public function getLastPublishedArticles($qty)
  {
    $qty = (int)$qty;
    $sql = "SELECT * FROM article ORDER BY published_at DESC LIMIT $qty;";
    $queryResponse = $this->preparedQuery($sql);
    $result = $queryResponse->statement->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);

    return array_map(fn ($data) => new Article($data), $result);
  }

  // public function getOneById($id)
  // {
  //   $queryResponse = $this->preparedQuery("SELECT * FROM article WHERE id_article = ?", [$id]);
  //   $data = $queryResponse->statement->fetch(PDO::FETCH_ASSOC);
  //   if ($data) {
  //     $article = new Article($data);
  //     return $article;
  //   } else {
  //     return null; // ou false
  //   }
  // }
}