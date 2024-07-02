<?php
$titre = "Phone Way Inscription";
require_once __DIR__ . "/templates/head.php";
require __DIR__ . "/templates/navbar.php"; ?>

<main class="d-flex justify-content-center align-items-center flex-column">
  <section class="container my-5 d-flex justify-content-center align-items-center">
    <div class="row loginFormStyle d-flex justify-content-center align-items-center">
      <h2 class="mb-4 text-center">Bienvenue chez Phone Way !</h2>
      <form class="border border-2 rounded-3 p-3">
        <div class="mb-3">
          <label for="inputNom" class="form-label">Nom :</label>
          <input type="text" class="form-control" id="inputNom" placeholder="Entrez votre nom" required>
        </div>
        <div class="mb-3">
          <label for="inputPrenom" class="form-label">Prénom :</label>
          <input type="text" class="form-control" id="inputPrenom" placeholder="Entrez votre prénom" required>
        </div>
        <div class="mb-3">
          <label for="inputPseudo" class="form-label">Pseudo :</label>
          <input type="text" class="form-control" id="inputPseudo" placeholder="Entrez votre pseudo" required>
        </div>
        <div class="mb-3">
          <label for="inputEmail" class="form-label">Adresse Email :</label>
          <input type="email" class="form-control" id="inputEmail" placeholder="Entrez votre email" required>
        </div>
        <div class="mb-3">
          <label for="inputPassword" class="form-label">Mot de passe :</label>
          <input type="password" class="form-control" id="inputPassword" placeholder="Entrez votre mot de passe" required>
        </div>
        <div class="mb-4">
          <label for="inputPasswordConfirm" class="form-label">Vérification du mot de passe :</label>
          <input type="password" class="form-control" id="inputPasswordConfirm" placeholder="Confirmez votre mot de passe" required>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-outline-dark btn-dark text-light">S'enregistrer</button>
        </div>
      </form>
    </div>
  </section>
</main>

<?php
require __DIR__ . "/templates/footer.php";
require __DIR__ . "/templates/foot.php"; ?>