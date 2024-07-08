<?php
// message 'form envoyé' ou d'erreur à l'envoi
$errors = [];
// si besoin de rediriger l'user, il ne faut pas de html avant. /!\
// on vérifie que le formulaire a été envoyé :
if (!empty($_POST)) {
  if (
    isset($_POST["inputEmail"], $_POST["inputPassword"])
    && !empty($_POST["inputEmail"])
    && !empty($_POST["inputPassword"])
  ) {

    // Vérification que l'adresse email est correcte
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "L'adresse email est incorrecte.";
    }

          // vérif de l'email utilisateur en base de données
    require_once __DIR__ . "/../config/database.php";
    try {
      // Début de la transaction
      $db->beginTransaction();



      // Vérification dans la table `compte`
      $sql = "SELECT * FROM 'compte' WHERE 'email' = :email";
      $query = $db->prepare($sql);
      $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

      // Validation de la transaction
      $db->commit();

    } catch (Exception $e) {
      // Annulation de la transaction en cas d'erreur
      $db->rollBack();
      die("Erreur lors de l'inscription : " . $e->getMessage());
    }



  }
}



$titre = "Phone Way Connexion";
require_once __DIR__ . "/templates/head.php"; ?>
<div class="wrapper">
  <?php require __DIR__ . "/templates/navbar.php"; ?>

  <main class="d-flex justify-content-center align-items-center flex-column">
    <section class="container my-5 d-flex justify-content-center align-items-center">
      <div class="row loginFormStyle d-flex justify-content-center align-items-center">
        <h2 class="mb-4 text-center">Bon retour parmi nous !</h2>
        <form class="border border-2 rounded-3 p-3" method="POST" novalidate>
          <div class="mb-3">
            <label for="inputEmail" class="form-label">Adresse Email :</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Entrez votre email" value="<?= isset($_POST['inputEmail']) ? htmlspecialchars($_POST['inputEmail']) : '' ?>" required>
            <?php if (!empty($errors['email'])) : ?>
              <p class="my-1" style="color: red;"><?php echo $errors['email']; ?></p>
            <?php endif; ?>
          </div>
          <div class=" mb-4">
            <label for="inputPassword" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Entrez votre mot de passe" required>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-dark btn-dark text-light">Se connecter</button>
          </div>
          <h5 class="mt-5 mb-2 text-center">Ou alors bienvenue !</h5>
          <div>
            <a href="/inscription" class="text-center">Pas encore de compte ? Inscrivez-vous ici</a>
          </div>

        </form>
      </div>
    </section>
  </main>

  <?php require __DIR__ . "/templates/footer.php"; ?>
</div>
<?php require __DIR__ . "/templates/foot.php"; ?>