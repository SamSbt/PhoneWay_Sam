<?php

namespace Entities;

class Article
{
  public int $id_article;
  public ?string $titre;
  public ?string $description;
  public ?string $published_at;
  public ?string $updated_at;
  public ?string $image_article;
  public int $id_marque;
  public ?int $id_gamme;
  public int $id_couleur;

  public function __construct($data = [])
  {
    $this->id_article = $data["Id_Article"] ?? 0;
    $this->titre = $data["Titre"] ?? null;
    $this->description = $data["Description"] ?? null;
    $this->published_at = $data["Published_At"] ?? null;
    $this->updated_at = $data["Updated_At"] ?? null;
    $this->image_article = $data["Image_Article"] ?? null;
    $this->id_marque = $data["Id_Marque"] ?? 0;
    $this->id_gamme = $data["Id_Gamme"] ?? null;
    $this->id_couleur = $data["Id_Couleur"] ?? 0;
  }
}
