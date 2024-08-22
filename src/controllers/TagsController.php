<?php

namespace Controllers;

use Repositories\TagRepository;

class TagsController extends BaseController
{
  public function index()
  {

    $tagRepository = new TagRepository();
    $attributes = [
      'tags' => $tagRepository,
      'pageTitle' => "PhoneWay - Tag",
    ];
    $this->render($attributes);
  }
}
