<?php

namespace Controllers;
use Repositories\ArticleRepository;
use Repositories\MarqueRepository;

class HomeController extends BaseController
{
  public function index(){
    // echo "<br />Executing " . get_called_class() . " -> " . __FUNCTION__ . "()";
    $articlesAndMarques = [];
    $articleRepository = new ArticleRepository();
    $marqueRepository = new MarqueRepository();
    $articles = $articleRepository->getLastPublishedArticles(12);
    foreach($articles as $article){
      $marque = $marqueRepository->getMarqueByMarqueId($article->id_marque);
      $articlesAndMarques[] = [
        "id"=> $article->id_article,
        "titre"=> $article->titre,
        "description"=> $article->description,
        "nom_marque"=>$marque->nom_marque,
      ];
    }
    // var_dump($articles);
    $attributes = [
      'articles' => $articlesAndMarques,
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