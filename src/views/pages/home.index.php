<?php
require_once __DIR__ . "/../partials/head.php"; ?>
<div class="wrapper">
  <?php require __DIR__ . "/../partials/navbar.php"; ?>


  <?php shuffle($articles);
  ?>

  <main class="d-flex justify-content-center align-items-center flex-column">
    <section class="container my-5">
      <div class="row">
        <?php foreach ($articles as $article) { ?>
          <?php
          $random_number = rand(1, 200);
          $image_url = "https://picsum.photos/200/100?random=" . $random_number;
          ?>

          <div class="d-flex justify-content-center col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card" style="width: 20rem;">
              <a href="/articles/details/<?= $article["id"] ?>" class="text-black" style="text-decoration: none; display: block;">
                <img src="<?= $image_url; ?>" class="card-img-top" alt="Photo de présentation de l'article">
                <div class="card-body">
                  <h6 class="card-title"><?= $article["titre"] ?></h6>
                  <p class="card-text mb-2"><?= $article["description"] ?></p>
                  <span>Série: <a href="#" class="btn btn-dark rounded-5"><?= $article["nom_marque"] ?></a></span>
                </div>
              </a>
            </div>
          </div>

        <?php } ?>
      </div>
    </section>
  </main>


  <?php require __DIR__ . "/../partials/footer.php"; ?>
</div>
<?php require __DIR__ . "/../partials/foot.php"; ?>