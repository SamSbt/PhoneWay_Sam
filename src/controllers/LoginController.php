<?php

namespace Controllers;

use Repositories\LoginRepository;

class LoginController extends BaseController
{
  public function index()
  {

    $loginRepository = new LoginRepository();
    $attributes = [
      'login' => $loginRepository,
      'pageTitle' => "PhoneWay - Se connecter",
    ];
    $this->render($attributes);
  }

  public function login()
  {
    // message 'form envoyé' ou d'erreur à l'envoi
    $errors = [];
    // si besoin de rediriger l'user, il ne faut pas de html avant. /!\
    // on vérifie que le formulaire a été envoyé :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST["inputEmail"], $_POST["inputPassword"])
        && !empty($_POST["inputEmail"])
        && !empty($_POST["inputPassword"])
      ) {

        $email = $_POST["inputEmail"];
        $password = $_POST["inputPassword"];

        // Vérification que l'adresse email est correcte
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "L'adresse email est incorrecte.";
        } else {
          $loginRepository = new LoginRepository();
          $user = $loginRepository->getUserByEmail($email);
          if ($user && password_verify($password, $user->password)) {
            // Logic for successful login, e.g., start session
          } else {
            $errors['login'] = "Email ou mot de passe incorrect.";
          }
        }
      }
    }
    $attributes = [
      'pageTitle' => "PhoneWay - Se connecter",
      'errors' => $errors,
    ];
    $this->render($attributes); // Renvoie à la vue `login.index`
  }
}
