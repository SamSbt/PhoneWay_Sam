<?php

namespace Controllers;

use Repositories\RegisterRepository;

class RegisterController extends BaseController
{
  public function index()
  {

    $registerRepository = new RegisterRepository();
    $attributes = [
      'articles' => $registerRepository,
      'pageTitle' => "PhoneWay - S'insscrire'",
    ];
    $this->render($attributes);
  }
}
