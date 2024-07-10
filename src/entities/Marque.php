<?php

namespace Entities;

class Marque
{
  public int $id_marque;
  public ?string $nom_marque;
  public ?string $image_marque;

  public function __construct($data = [])
  {
    $this->id_marque = $data["Id_Marque"] ?? 0;
    $this->nom_marque = $data["Nom_Marque"] ?? null;
    $this->image_marque = $data["Image_Marque"] ?? null;
  }
}
