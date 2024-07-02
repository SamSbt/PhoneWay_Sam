      <?php
      include_once __DIR__ . "/../configs/db.config.php";
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
        $sql = "SELECT a.Titre, a.Description, m.Nom_Marque 
        FROM article AS a
        JOIN marque AS m ON a.Id_Marque = m.Id_Marque
        ORDER BY Published_at DESC LIMIT 12";
        $stmt = $db->query($sql);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        exit;
      }

require __DIR__ . "/../views/index.view.php";