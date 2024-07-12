<?php

namespace Repositories;

use Entities\Compte;
use Exception;
use PDO;

class LoginRepository extends BaseRepository
{
  public function getUserByEmail(string $email): ?Compte
  {
    try {
      $db = $this->connect();
      // Début de la transaction
      $db->beginTransaction();

      // Vérification dans la table `compte`
      $sql = "SELECT * FROM 'compte' WHERE 'email' = :email";
      $query = $db->prepare($sql);
      $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
      $query->execute();

      $result = $query->fetch(PDO::FETCH_ASSOC);

      // Validation de la transaction
      $db->commit();

      if ($result) {
        return new Compte($result);
      }
      return null;
    } catch (Exception $e) {
      // Annulation de la transaction en cas d'erreur
      $db->rollBack();
      die("Erreur lors de l'inscription : " . $e->getMessage());
    }
  }
}
