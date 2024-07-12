<?php

namespace Entities;

class Compte
{
  public int $id_compte;
  public string $email;
  public ?string $password;
  public int $is_valid;
  public int $id_utilisateur;

  public function __construct($data = [])
  {
    $this->id_compte = $data["Id_Compte"] ?? 0;
    $this->email = $data["email"] ?? 0;
    $this->password = $data["Password"] ?? null;
    $this->is_valid = $data["is_valid"] ?? 1;
    $this->id_utilisateur = $data["Id_Utilisateur"] ?? 0;
  }
}
