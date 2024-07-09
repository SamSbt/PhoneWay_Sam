<?php

namespace Controllers;
use Repositories\ArticleRepository;

class HomeController extends BaseController
{
  public function index(){
    // echo "<br />Executing " . get_called_class() . " -> " . __FUNCTION__ . "()";
    $articleRepository = new ArticleRepository();
    $articles =$articleRepository->getLastPublishedArticles(2);
    // var_dump($articles);
    $attributes = [
      'articles' => $articles,
      'pageTitle' => "PhoneWay - Accueil",
    ];
    $this->render($attributes);
  }
}

// <?php
// require_once __DIR__ . "/../config/database.php";

// try {
// $sql = "SELECT a.id_article, a.Titre, a.Description, m.Nom_Marque
// FROM article AS a
// JOIN marque AS m ON a.Id_Marque = m.Id_Marque
// ORDER BY Published_at DESC LIMIT 12";
// $stmt = $db->query($sql);
// $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (PDOException $e) {
// echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
// exit;
// }

// require __DIR__ . "/../views/index.view.php";