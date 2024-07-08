<?php
// message 'form envoyé' ou d'erreur à l'envoi
$message = '';
$message_type = '';
$errors = [];
// si besoin de rediriger l'user, il ne faut pas de html avant. /!\
// on vérifie que le formulaire a été envoyé :
if (!empty($_POST)) {
  // on vérifie que tous les champs sont remplis :
  if (
    isset($_POST["inputNom"], $_POST["inputPrenom"], $_POST["inputPseudo"], $_POST["inputEmail"], $_POST["inputPassword"])
    && !empty($_POST["inputNom"]) && !empty($_POST["inputPrenom"]) && !empty($_POST["inputPseudo"]) && !empty($_POST["inputEmail"])
    && !empty($_POST["inputPassword"])
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

      // création de l'utilisateur en base de données
      require_once __DIR__ . "/../config/database.php";
      try {
        // Début de la transaction
        $db->beginTransaction();

        // Insertion dans la table `utilisateur`
        $sql = "INSERT INTO utilisateur (username, nom_utilisateur, prenom_utilisateur) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username, $nom_utilisateur, $prenom_utilisateur]);

        // Récupération de l'ID de l'utilisateur nouvellement créé
        $utilisateur_id = $db->lastInsertId();

        // Insertion dans la table `compte`
        $sql = "INSERT INTO compte (email, password, id_utilisateur) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email, $password_hashed, $utilisateur_id]);

        // Validation de la transaction
        $db->commit();

        $message = 'Inscription réussie ! Veuillez vérifier votre boîte email.';
        $message_type = 'success';
      } catch (Exception $e) {
        // Annulation de la transaction en cas d'erreur
        $db->rollBack();
        die("Erreur lors de l'inscription : " . $e->getMessage());
      }
    }
  } else {
    // form non complet
    $message = 'Veuillez remplir tous les champs.';
    $message_type = 'danger';
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

        <?php if ($message) : ?>
          <div class="alert alert-<?= htmlspecialchars($message_type) ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <!-- script pour éviter que le formulaire soit soumis à nouveau si l'utilisateur rafraîchit la page : -->
          <script>
            if (history.replaceState) {
              history.replaceState(null, null, location.href);
            }
          </script>
        <?php endif; ?>

        <!-- les values ici permettent de conserver ce qui a été saisi à l'envoi si jamais qqch ne convient pas -->
        <form class="border border-2 rounded-3 p-3" method="POST" novalidate>
          <div class="mb-3">
            <label for="inputNom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="inputNom" name="inputNom" placeholder="Entrez votre nom" value="<?= isset($_POST['inputNom']) ? htmlspecialchars($_POST['inputNom']) : '' ?>" required>
          </div>
          <div class=" mb-3">
            <label for="inputPrenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="inputPrenom" name="inputPrenom" placeholder="Entrez votre prénom" value="<?= isset($_POST['inputPrenom']) ? htmlspecialchars($_POST['inputPrenom']) : '' ?>" required>
          </div>
          <div class=" mb-3">
            <label for="inputPseudo" class="form-label">Pseudo :</label>
            <input type="text" class="form-control" id="inputPseudo" name="inputPseudo" placeholder="Entrez votre pseudo" value="<?= isset($_POST['inputPseudo']) ? htmlspecialchars($_POST['inputPseudo']) : '' ?>" required>
          </div>
          <div class=" mb-3">
            <label for="inputEmail" class="form-label">Adresse Email :</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Entrez votre email" value="<?= isset($_POST['inputEmail']) ? htmlspecialchars($_POST['inputEmail']) : '' ?>" required>
            <?php if (!empty($errors['email'])) : ?>
              <p class="my-1" style="color: red;"><?php echo $errors['email']; ?></p>
            <?php endif; ?>
          </div>
          <div class=" mb-3">
            <label for="inputPassword" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Entrez votre mot de passe" required>
            <?php if (!empty($errors['password'])) : ?>
              <p class="my-1" style="color: red;"><?php echo $errors['password']; ?></p>
            <?php endif; ?>
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