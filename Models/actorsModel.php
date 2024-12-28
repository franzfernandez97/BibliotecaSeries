<?php
  require_once 'database.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';


  class Actors {
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

    public function getById(int $id):array | string | null {
      $query = "SELECT * FROM $this->table WHERE id = ?";
      try {
        if ($stmt = $this->db->prepare($query)) {
          $stmt->bind_param("i", $id);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            $actor = [];
            while ($row = $result->fetch_assoc()) {
              $actor[] = $row;
            }
            $stmt->close();
            return $actor;
          } else {
              return [];
          }
        }
      }catch (mysqli_sql_exception $e) {
        return $e->getMessage();
      }
    }

    public function createActor(array $data):int | string {
      $query = "INSERT INTO $this->table (firstname, lastname, birthdate, nationality) VALUES (?,?,?,?)";

      if ($stmt = $this->db->prepare($query)) {
        $stmt->bind_param("ssss", $data[0],$data[1],$data[2],$data[3]);
        if($stmt->execute()) {
          $idCreated = $this->db->insert_id;
          $stmt->close();
          return $idCreated;
        }
      }
    }
    public function updateActor($id, $data): bool|string|mysqli_stmt{
      $query = "UPDATE $this->table SET firstname = ?, lastname = ?, birthdate = ?, nationality = ? WHERE id = ?";

      if ($stmt = $this->db->prepare($query)) {
        $stmt->bind_param("ssssi", $data[0], $data[1], $data[2], $data[3], $id);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
          $stmt->close();
          return "Error: " . $stmt->error . "\n";
        }
      }
    }

    public function deleteActor($id):bool|string {
      try {
        $query = "DELETE FROM $this->table WHERE id = ?";
        if ($stmt = $this->db->prepare($query)) {
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
            $stmt->close();
            return true;
          } else {
            $stmt->close();
            return false;
          }
        }
      } catch(mysqli_sql_exception $e) {
        return $e->getMessage();
      }
    }

  }
?>
