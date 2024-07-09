<?php

namespace Controllers;
use Repositories\ArticleRepository;

include_once '../utils/functions.php';

class ArticlesController extends BaseController
{
    public function details()
    {
        // Vérifier si ID non défini / si n'est pas un nombre / si inférieur à 1 : renvoi sur func 404
        if (!isset($this->params[0]) || !is_numeric($this->params[0]) || (int)$this->params[0] < 1) {
            redirect404();
        }

        $id = (int)$this->params[0];

        // echo "<br/>Executing " . get_called_class() . " -> " . __FUNCTION__ . "() with id=" . $id ."<br />";

        // Récupérer l'article par ID
        $articleRepository = new ArticleRepository();
        $article = $articleRepository->getOneById($id);
        // var_dump($article); 

        // Si l'article n'existe pas, rediriger vers la page 404
        if (!$article) {
            redirect404();
        }

        $attributes = [
            'article' => $article,
            'pageTitle' => "PhoneWay - Article : ". $article->titre,
        ];
        $this->render($attributes);
    }

}



// <?php
// require_once __DIR__ . "/../config/database.php";

// $id_article = $_GET['id'] ?? null;
// if ($id_article) {
//   try {
//     $sql = "SELECT a.id_article, a.Titre as titre, a.Description as summary, a.Published_at as published_at, a.Updated_at as updated_at, m.Nom_Marque 
//             FROM article AS a 
//             JOIN marque AS m ON a.Id_Marque = m.Id_Marque 
//             WHERE a.id_article = ?;";
//     $stmt = $db->prepare($sql);
//     $stmt->execute([$_GET['id']]);
//     $article = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($article) {
//       require __DIR__ . "/../views/templates/article.php";
//     } else {
//       throw new Exception("Article not found");
//     }
//   } catch (PDOException $e) {
//     echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
//     exit;
//   } catch (Exception $e) {
//     abort(404);
//   }
// } else {
//   abort(404);
// }
