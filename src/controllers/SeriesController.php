<?php

namespace Controllers;

use Repositories\SerieRepository;

class SeriesController extends BaseController
{
  public function index()
  {

    $serieRepository = new SerieRepository();
    $attributes = [
      'articles' => $serieRepository,
      'pageTitle' => "PhoneWay - Séries",
    ];
    $this->render($attributes);
  }
}
