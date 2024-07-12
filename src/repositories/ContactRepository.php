<?php

namespace Repositories;

use PDOException;

class ContactRepository extends BaseRepository
{
  public function insertContact($fullname, $email, $message)
  {
    $sql = "INSERT INTO contact (fullname, email, message) VALUES (?, ?, ?);";
    try {
      $stmt = $this->connect()->prepare($sql);
      $result = $stmt->execute([$fullname, $email, $message]);
      return $stmt->rowCount() == 1;
    } catch (PDOException $e) {
      throw new PDOException("Erreur lors de l'insertion : " . $e->getMessage());
    }
  }
}
