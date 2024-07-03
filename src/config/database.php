  <?php
  require_once __DIR__ . "/db.config.php";
  // débogage du code
  try {
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    $user = DB_USER;
    $pass = DB_PASSWORD;

    $db = new PDO(
      $dsn,
      $user,
      $pass,
      array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
      )
    );
  } catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
  }