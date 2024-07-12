<?php

namespace Entities;

class Utilisateur
{
  public int $id_utilisateur;
  public ?string $username;
  public ?string $nom_utilisateur;
  public ?string $prenom_utilisateur;
  public int $id_role;

  public function __construct($data = [])
  {
    $this->id_utilisateur = $data["Id_Utilisateur"] ?? 0;
    $this->username = $data["Username"] ?? null;
    $this->nom_utilisateur = $data["Nom_Utilisateur"] ?? null;
    $this->prenom_utilisateur = $data["Prenom_Utilisateur"] ?? null;
    $this->id_role = $data["Id_Role"] ?? 1;
  }
}
