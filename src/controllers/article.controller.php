<?php
require_once __DIR__ . "/../config/database.php";

$id_article = $_GET['id'] ?? null;
if ($id_article) {
  try {
    $sql = "SELECT a.id_article, a.Titre as titre, a.Description as summary, a.Published_at as published_at, a.Updated_at as updated_at, m.Nom_Marque 
            FROM article AS a 
            JOIN marque AS m ON a.Id_Marque = m.Id_Marque 
            WHERE a.id_article = :id_article";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
      require __DIR__ . "/../views/templates/article.php";
    } else {
      throw new Exception("Article not found");
    }
  } catch (PDOException $e) {
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    exit;
  } catch (Exception $e) {
    abort(404);
  }
} else {
  abort(404);
}
