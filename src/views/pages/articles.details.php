<?php
require_once __DIR__ . "/../partials/head.php"; ?>
<div class="wrapper">
  <?php require __DIR__ . "/../partials/navbar.php"; ?>


  <main class="mt-5 pt-3 row">
    <div class="col-12">
      <div class="text-center my-3">
        <h3 class="mt-5"><?= $article->titre ?></h3>
        <img src=" https://picsum.photos/600/300?random=<?= rand(1, 200) ?>" class="mt-3" alt="Photo de présentation de l'article">
      </div>

      <div class="d-flex justify-content-center align-items-center flex-column">
        <p class="text-center my-3 mx-5 w-50">
          <?= $article->summary ?>
        </p>
        <p class="text-center">
          <i>Publié le <?= date("d/m/Y", strtotime($article->published_at)); ?>
            <?php
            if (isset($article->updated_at)) {
            ?>
              (Mis à jour le <?= date("d/m/Y", strtotime($article->updated_at)); ?>)</i>
        <?php
            }
        ?>
        </p>
      </div>

    </div>
  </main>


  <?php require __DIR__ . "/../partials/footer.php"; ?>
</div>
<?php require __DIR__ . "/../partials/foot.php"; ?>