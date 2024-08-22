<?php

namespace Entities;

class Gamme
{
  public int $id_gamme;
  public ?string $nom_gamme;

  public function __construct($data = [])
  {
    $this->id_gamme = $data["Id_Gamme"] ?? 0;
    $this->nom_gamme = $data["Nom_Gamme"] ?? null;
  }
}
