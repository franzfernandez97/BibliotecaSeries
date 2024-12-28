<?php
  require_once 'database.php';


  class Actors {

    private $table = 'actors';
    private $actorId;
    private $firstName;
    private $lastName;
    private $birthName;
    private $nationality;

    public function __construct($actorId, $firstName, $lastName, $birthName, $nationality) {
      $this->actorId = $actorId;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->birthName = $birthName;
      $this->nationality = $nationality;
    }
    //GETTERS
    public function getActorId():int {
      return $this->actorId;
    }
    public function getFirstName():string {
      return $this->firstName;
    }
    public function getLastName():string {
      return $this->lastName;
    }
    public function getBirthName():string {
      return $this->birthName;
    }
    public function getNationality():string {
      return $this->nationality;
    }
    //SETTERS
    public function setActorId(int $actorId): void {
      $this->actorId = $actorId;
    }
    public function setFirstName(string $firstName): void {
      $this->firstName = $firstName;
    }
    public function setLastName(string $lastName): void {
      $this->lastName = $lastName;
    }
    public function setBirthName(string $birthName): void {
      $this->birthName = $birthName;
    }
    public function setNationality(string $nationality): void {
      $this->nationality = $nationality;
    }
    public function getAll():Array {
      $mysqli = Database::getDbConnection();
      $query = "SELECT * FROM $this->table";
      $result = $mysqli->query($query);
      $listData = [];

      if ($result->num_rows > 0) {
          foreach ($result as $item){
            $itemObject = new Actors($item['id'], $item['firstname'], $item['lastname'], $item['birthname'], $item['nationality']);
            array_push($listData, $itemObject);
          }
      }
      $mysqli->close();
      return $listData;
    }

    public function getById(int $id):array{
      $mysqli = Database::getDbConnection();
      $query = 'SELECT * FROM platforms WHERE id = ?';
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $actor = [];
      if ($result->num_rows > 0) {
        foreach ($result as $item){
          $itemObject = new Actors($item['id'], $item['firstname'], $item['lastname'], $item['birthname'], $item['nationality']);
          array_push($actor, $itemObject);
        }
      }
      $mysqli->close();
      return $actor;
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
