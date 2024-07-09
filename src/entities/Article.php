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
  public ?int $id_marque;
  public ?int $id_gamme;
  public ?int $id_couleur;

  function __construct($fields = [])
  {
    foreach ($fields as $key => $value) {
      if (property_exists($this, $key)) {
        $this->$key = $value;
      }
    }
  }
}
