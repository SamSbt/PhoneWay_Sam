<?php

namespace Controllers;

use Exception;
use Repositories\RegisterRepository;
use Entities\Compte;
use Entities\Utilisateur;

class RegisterController extends BaseController
{
  public function index()
  {
    $registerRepository = new RegisterRepository();
    $attributes = [
      'register' => $registerRepository,
      'pageTitle' => "PhoneWay - S'inscrire'",
    ];
    $this->render($attributes);
  }

  public function register()
  {
    // message 'form envoyé' ou d'erreur à l'envoi
    $errors = [];
    $message = '';
    $message_type = '';
    // si besoin de rediriger l'user, il ne faut pas de html avant. /!\
    // on vérifie que le formulaire a été envoyé :
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        // on vérifie que tous les champs sont remplis :
        isset($_POST["inputNom"], $_POST["inputPrenom"], $_POST["inputPseudo"], $_POST["inputEmail"], $_POST["inputPassword"]) &&
        !empty($_POST["inputNom"]) && !empty($_POST["inputPrenom"]) && !empty($_POST["inputPseudo"]) && !empty($_POST["inputEmail"]) &&
        !empty($_POST["inputPassword"])
      ) {
        // form complet
        // récupération des données du formulaire :
        $username = htmlspecialchars($_POST['inputPseudo']);
        $nom_utilisateur = htmlspecialchars($_POST['inputNom']);
        $prenom_utilisateur = htmlspecialchars($_POST['inputPrenom']);
        $email = htmlspecialchars($_POST['inputEmail']);
        $password = $_POST['inputPassword'];

            // Vérification que l'adresse email est correcte
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "L'adresse email est incorrecte.";
        }
 // vérification de la complexité du mot de passe
        if (
          !(strlen($password) >= 8) ||
          !preg_match('/[a-z]/', $password) ||   // Au moins une lettre minuscule
          !preg_match('/[A-Z]/', $password) ||   // Au moins une lettre majuscule
          !preg_match('/[0-9]/', $password) ||   // Au moins un chiffre
          !preg_match('/[^a-zA-Z0-9]/', $password)  // Au moins un caractère spécial
        ) {
          $errors['password'] = "Votre mot de passe doit contenir 8 caractères minimum, des lettres minuscules, majuscules, des chiffres et des caractères spéciaux.";
        }

        if (empty($errors)) {
          // Hashage du mot de passe, méthode pour PHP8+ 
          $password_hashed = password_hash($password, PASSWORD_ARGON2ID);

          $registerRepository = new RegisterRepository();
          
            $utilisateur = new Utilisateur([
              "Username" => $username,
              "Nom_Utilisateur" => $nom_utilisateur,
              "Prenom_Utilisateur" => $prenom_utilisateur,
            ]);

            $compte = new Compte([
              "email" => $email,
              "Password" => $password_hashed,
              "is_valid" => 1,
            ]);
try {
            $registerRepository->registerUser($utilisateur, $compte);
            $message = 'Inscription réussie ! Veuillez vérifier votre boîte email.';
            $message_type = 'success';
          } catch (Exception $e) {
            $errors['registration'] = "Erreur lors de l'inscription : " . $e->getMessage();
          }
        }
      } else {
        $errors['form'] = 'Veuillez remplir tous les champs.';
        $message_type = 'danger';
      }
    }

    $attributes = [
      'pageTitle' => "PhoneWay - S'inscrire",
      'message' => $message,
      'message_type' => $message_type,
      'errors' => $errors,
    ];
    $this->render($attributes);
  }
}
