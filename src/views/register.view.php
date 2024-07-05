<?php
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
    $password = password_hash($_POST['inputPassword'], PASSWORD_ARGON2ID); //méthode hashage pour PHP8+ 

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      die("L'adresse email est incorrecte.");
      // email valide
      // vérification que le mot de passe est assez long et contient des lettres minuscules, majuscules, chiffres et des caractères spéciaux
      // if (
      //   strlen($_POST['inputPassword']) >= 8 && preg_match('/[a-z]/', $_POST['inputPassword']) && preg_match('/[A-Z]/', $_POST['inputPassword'])
      //   && preg_match('/[0-9]/', $_POST['inputPassword']) && preg_match('/[^a-zA-Z0-9]/', $_POST['inputPassword'])
      // ) {
      //   die("Votre mot de passe doit contenir 8 caractères minimum, des lettres minuscules, majuscules, des chiffres et des caractères spéciaux.");
      // }
    }
    // mot de passe correct
    // vérification que le mot de passe et sa confirmation sont identiques
    // if ($_POST['inputPassword'] === $_POST['inputPasswordConfirm']) {}
  }

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
    $stmt->execute([$email, $password, $utilisateur_id]);

    // Validation de la transaction
    $db->commit();
?>

    <div class="alert alert-success alert dismissible fade show marginSendMsg" role="alert">
      Inscription réussie ! Veuillez vérifier votre boîte email.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
      if (history.replaceState) {
        history.replaceState(null, null, location.href);
      }
    </script>

<?php
  } catch (Exception $e) {
    // Annulation de la transaction en cas d'erreur
    $db->rollBack();
    die("Erreur lors de l'inscription : " . $e->getMessage());
  }
} else {
  // form non complet

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
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-dark btn-dark text-light">S'enregistrer</button>
          </div>
        </form>
      </div>
    </section>
  </main>
<?php } ?>

  <?php require __DIR__ . "/templates/footer.php"; ?>
</div>
<?php require __DIR__ . "/templates/foot.php"; ?>


