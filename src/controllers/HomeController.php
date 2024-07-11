<?php

namespace Controllers;
use Repositories\ArticleRepository;
use Repositories\MarqueRepository;

class HomeController extends BaseController
{
  public function index(){
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

