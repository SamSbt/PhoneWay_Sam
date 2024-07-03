<?php
// si besoin de rediriger l'user, il ne faut pas de html avant. /!\
// on vérifie que le formulaire a été envoyé :
if (!empty($_POST)) {



  // on vérifie que tous les champs sont remplis :
  if (
    isset($_POST["inputNom"], $_POST["inputPrenom"], $_POST["inputPseudo"], $_POST["inputEmail"], $_POST["inputPassword"], $_POST["inputPasswordConfirm"])
    && !empty($_POST["inputNom"]) && !empty($_POST["inputPrenom"]) && !empty($_POST["inputPseudo"]) && !empty($_POST["inputEmail"])
    && !empty($_POST["inputPassword"]) && !empty($_POST["inputPasswordConfirm"])
  ) {
    // form complet
    // récupération des données du formulaire :
    $nom = htmlspecialchars($_POST['inputNom']);
    $prenom = htmlspecialchars($_POST['inputPrenom']);
    $pseudo = htmlspecialchars($_POST['inputPseudo']);
    $email = htmlspecialchars($_POST['inputEmail']);
    $password = $_POST['inputPassword'];
    $passwordConfirm = $_POST['inputPasswordConfirm'];
    $motDePasse = password_hash($_POST['inputPassword'], PASSWORD_ARGON2ID);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      die("L'adresse email est incorrecte.");
      // email valide
      // vérification que le mot de passe est assez long et contient des lettres minuscules, majuscules, chiffres et des caractères spéciaux
      // if (strlen($_POST['inputPassword']) >= 8 && preg_match('/[a-z]/', $_POST['inputPassword']) && preg_match('/[A-Z]/', $_POST['inputPassword']) && preg_match('/[0-9]/', $_POST['inputPassword']) && preg_match('/[^a-zA-Z0-9]/', $_POST['inputPassword'])) {
        // mot de passe correct
        // vérification que le mot de passe et sa confirmation sont identiques
        // if ($_POST['inputPassword'] === $_POST['inputPasswordConfirm']) {
          // mots de passe identiques
          // création de l'utilisateur en base de données
          
    }

  } else {
    // form non complet
    die("Le formulaire est incomplet.");
  }
}







$titre = "Phone Way Inscription";
require_once __DIR__ . "/templates/head.php"; ?>
<div class="wrapper">
  <?php require __DIR__ . "/templates/navbar.php"; ?>

  <main class="d-flex justify-content-center align-items-center flex-column">
    <section class="container my-5 d-flex justify-content-center align-items-center">
      <div class="row loginFormStyle d-flex justify-content-center align-items-center">
        <h2 class="mb-4 text-center">Bienvenue chez Phone Way !</h2>
        <form class="border border-2 rounded-3 p-3" method="POST" novalidate>
          <div class="mb-3">
            <label for="inputNom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Entrez votre nom" required>
          </div>
          <div class="mb-3">
            <label for="inputPrenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="inputPrenom" name="inputPrenom" placeholder="Entrez votre prénom" required>
          </div>
          <div class="mb-3">
            <label for="inputPseudo" class="form-label">Pseudo :</label>
            <input type="text" class="form-control" id="inputPseudo" name="inputPseudo" placeholder="Entrez votre pseudo" required>
          </div>
          <div class="mb-3">
            <label for="inputEmail" class="form-label">Adresse Email :</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Entrez votre email" required>
          </div>
          <div class="mb-3">
            <label for="inputPassword" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Entrez votre mot de passe" required>
          </div>
          <div class="mb-4">
            <label for="inputPasswordConfirm" class="form-label">Vérification du mot de passe :</label>
            <input type="password" class="form-control" id="inputPasswordConfirm" name="inputPasswordConfirm" placeholder="Confirmez votre mot de passe" required>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-dark btn-dark text-light">S'enregistrer</button>
          </div>
        </form>
      </div>
    </section>
  </main>

  <?php require __DIR__ . "/templates/footer.php"; ?>
</div>
<?php require __DIR__ . "/templates/foot.php"; ?>