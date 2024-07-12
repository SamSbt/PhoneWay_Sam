<?php

namespace Controllers;

use Repositories\LoginRepository;

class LoginController extends BaseController
{
  public function index()
  {

    $loginRepository = new LoginRepository();
    $attributes = [
      'articles' => $loginRepository,
      'pageTitle' => "PhoneWay - Se connecter",
    ];
    $this->render($attributes);
  }
}
