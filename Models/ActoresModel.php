<?php
  require_once 'Database.php';
  require_once '../Config/Config.php';


  class Actores {
    private $db;
    private $table = 'actors';

    public function __construct() {
      // Load the database credentials using the simplified Config class
      $credentials = Config::getDbCredentials();

      // Create an instance of the Database class and connect to DB
      $dbInstance = new Database($credentials['host'], $credentials['user'], $credentials['password'], $credentials['dbname']);
      $connection = $dbInstance->connect();

      // If connection fails (returns an error message), exit
      if (is_string($connection)) {
          echo $connection;
          exit;
      }

      // Otherwise, set the connection
      $this->db = $connection;
    }
    public function getAll() {
      $query = "SELECT * FROM $this->table";
      $result = $this->db->query($query);
      if ($result->num_rows > 0) {
        $actors = [];
        while ($row = $result->fetch_assoc()) {
          $actors[] = $row;
        }
        return $actors;
      } else {
          return [];
      }
    }

    public function getById(int $id):array|string|mysqli_result|bool {
      $query = "SELECT * FROM $this->table WHERE id = ?";
      try {
        if ($stmt = $this->db->prepare($query)) {
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            return $result->fetch_assoc();
          } else {
              return [];
          }
        }
      }catch (mysqli_sql_exception $e) {
        return $e->getMessage();
      }
    }
  }

?>
