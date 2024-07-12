<?php

namespace Repositories;

use Entities\Compte;
use Entities\Utilisateur;
use Exception;

class RegisterRepository extends BaseRepository
{
  public function registerUser(Utilisateur $utilisateur, Compte $compte)
  {
    $db = $this->connect();
    try {
      $db->beginTransaction();

      $sql = "INSERT INTO utilisateur (username, nom_utilisateur, prenom_utilisateur) VALUES (?, ?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->execute([
        $utilisateur->username,
        $utilisateur->nom_utilisateur,
        $utilisateur->prenom_utilisateur,]);

      $utilisateur_id = $db->lastInsertId();

      $sql = "INSERT INTO compte (email, password, id_utilisateur) VALUES (?, ?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->execute([
        $compte->email,
        $compte->password,
        $compte->is_valid,
        $utilisateur_id,]);

      $db->commit();
    } catch (Exception $e) {
      // Annulation de la transaction en cas d'erreur
      $db->rollBack();
      throw new Exception("Erreur lors de l'enregistrement de l'utilisateur : " . $e->getMessage());
    }
  }
}
