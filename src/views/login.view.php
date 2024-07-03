<?php
$titre = "Phone Way Connexion";
require_once __DIR__ . "/templates/head.php"; ?>
<div class="wrapper">
  <?php require __DIR__ . "/templates/navbar.php"; ?>

  <main class="d-flex justify-content-center align-items-center flex-column">
    <section class="container my-5 d-flex justify-content-center align-items-center">
      <div class="row loginFormStyle d-flex justify-content-center align-items-center">
        <h2 class="mb-4 text-center">Bon retour parmi nous !</h2>
        <form class="border border-2 rounded-3 p-3">
          <div class="mb-3">
            <label for="inputEmail" class="form-label">Adresse Email :</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Entrez votre email" required>
          </div>
          <div class="mb-4">
            <label for="inputPassword" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="inputPassword" placeholder="Entrez votre mot de passe" required>
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