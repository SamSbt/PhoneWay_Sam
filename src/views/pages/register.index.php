<?php 
require_once __DIR__ . "/../partials/head.php"; ?>
<div class="wrapper">
  <?php require __DIR__ . "/../partials/navbar.php"; ?>

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

  <?php require __DIR__ . "/../partials/footer.php"; ?>
</div>
<?php require __DIR__ . "/../partials/foot.php"; ?>