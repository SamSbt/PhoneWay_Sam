<?php
if (isset($_POST['send'])) {
  // fonction pour se prémunir des failles xss
  $fullname = htmlspecialchars($_POST['fullname']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  require_once __DIR__ . "/../../config/database.php";

  try {
    $sql = "INSERT INTO contact (fullname, email, message) VALUES (?, ?, ?);";
    // protection contre les injections SQL
    $stmt = $db->prepare($sql);
    $result = $stmt->execute([$fullname, $email, $message]);
    $result = $stmt->rowCount() == 1;

    if ($result) { ?>
      <div class="alert alert-success alert dismissible fade show marginSendMsg" role="alert">
        Merci pour votre message <?= $fullname; ?>.<br />
        Vous recevrez une réponse à l'adresse email indiquée (<?= $email ?>).
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <!-- script pour éviter que le formulaire soit soumis à nouveau si l'utilisateur rafraîchit la page : -->
      <script>
        if (history.replaceState) {
          history.replaceState(null, null, location.href);
        }
      </script>
<?php }
  } catch (PDOException $e) {
    echo "Erreur lors de l'insertion : " . $e->getMessage();
  }
}
?>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Contactez-nous</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="contactForm" method="POST" action="" novalidate>
          <div class="mb-3">
            <label class="form-label" for="fullname">Name</label>
            <input class="form-control" id="fullname" name="fullname" type="text" placeholder="Name" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="email"></label>
            <input class="form-control" id="email" name="email" type="text" placeholder="Email Address" autocomplete="email" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="message">Message</label>
            <textarea class="form-control" id="message" name="message" type="text" placeholder="Message" style="height: 10rem;" required></textarea>
          </div>
          <div class="mb-1 text-center">
            <button class="btn btn-outline-dark btn-dark text-light" name="send" type="submit">Envoyer</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>