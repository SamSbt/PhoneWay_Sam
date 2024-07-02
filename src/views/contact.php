<?php require_once __DIR__ . "/templates/head.php"; ?>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Contactez-nous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="contactForm" method="POST" action="">
          <div class="mb-3">
            <label class="form-label" for="fullname">Name</label>
            <input class="form-control" name="fullname" type="text" placeholder="Name">
          </div>
          <div class="mb-3">
            <label class="form-label" for="email"></label>
            <input class="form-control" name="email" type="text" placeholder="Email Address">
          </div>
          <div class="mb-3">
            <label class="form-label" for="message">Message</label>
            <textarea class="form-control" name="message" type="text" placeholder="Message" style="height: 10rem;"></textarea>
          </div>
          <div class="mb-1 text-center">
            <button class="btn btn-success" name="send" type="submit">Envoyer</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<?php
if (isset($_POST['send'])) {
  $fullname = htmlspecialchars($_POST['fullname']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);
  include_once "./configs/db.config.php";
  $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
  $user = DB_USER;
  $pass = DB_PASSWORD;

  // débogage du code suite à des erreurs de frappe
  echo "DSN: $dsn<br>";
  try {
    $db = new PDO(
      $dsn,
      $user,
      $pass,
      array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
      )
    );

    $db = new PDO(
      $dsn,
      $user,
      $pass,
      array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
      )
    );
    $sql = "INSERT INTO contact (fullname, email, message) VALUES (:fullname, :email, :message);";
    $stmt = $db->prepare($sql);

    // Liaison des paramètres pour se protéger contre les injections SQL
    $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);

    $stmt->execute();
    $result = $stmt->rowCount() == 1;
  } catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
  }

  if ($result) { ?>
    <div class="alert alert-success alert dismissible fade show" role="alert" style="margin-top: 80px; margin-bottom:-40px;">
      Votre message est envoyé.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php }
}
?>

<?php require __DIR__ . "/templates/foot.php"; ?>