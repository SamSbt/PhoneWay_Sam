<?php
require_once __DIR__ . "/../partials/head.php"; ?>
<div class="wrapper">
  <?php require __DIR__ . "/../partials/navbar.php"; ?>

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
            <a href="/register" class="text-center">Pas encore de compte ? Inscrivez-vous ici</a>
          </div>

        </form>
      </div>
    </section>
  </main>

  <?php require __DIR__ . "/../partials/footer.php"; ?>
</div>
<?php require __DIR__ . "/../partials/foot.php"; ?>