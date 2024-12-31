<?php
  require_once 'database.php';


  class Actors {

    private $table = 'actors';
    private $actorId;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $nationality;

    public function __construct($actorId=null, $firstName=null, $lastName=null, $birthDate=null, $nationality=null) {
      $this->actorId = $actorId;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->birthDate = $birthDate;
      $this->nationality = $nationality;
    }
    //GETTERS
    public function getActorId():int {
      return (int)$this->actorId;
    }
    public function getFirstName():string {
      return $this->firstName;
    }
    public function getLastName():string {
      return $this->lastName;
    }
    public function getbirthDate():string {
      return $this->birthDate;
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
    public function setbirthDate(string $birthDate): void {
      $this->birthDate = $birthDate;
    }
    public function setNationality(string $nationality): void {
      $this->nationality = $nationality;
    }
    public function getAll():array {
      $mysqli = Database::getDbConnection();
      $query = "SELECT * FROM $this->table";
      $result = $mysqli->query($query);
      $listData = [];

      if ($result->num_rows > 0) {
          foreach ($result as $item){
            $itemObject = new Actors((int)$item['id'], $item['firstname'], $item['lastname'], $item['birthdate'], $item['nationality']);
            array_push($listData, $itemObject);
          }
      }
      $mysqli->close();
      return $listData;
    }

    public function getById(){
      $mysqli = Database::getDbConnection();
      $query = 'SELECT * FROM actors WHERE id = ?';
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $this->actorId);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0){
        foreach ($result as $item){
            $itemObject = new Actors($item["id"], $item["firstname"], $item['lastname'], $item['birthdate'], nationality: $item['nationality']);
            return $itemObject;
        }
      }
      $mysqli->close();
      return false;
    }

    public function createActor(){
      $platformCreated = false;
      $mysqli = Database::getDbConnection();

      // Use prepared statement to prevent SQL injection
      $stmt = $mysqli->prepare("SELECT firstname, lastname FROM $this->table WHERE firstname = ? AND lastname = ?");
      $stmt->bind_param("ss", $this->firstName, $this->lastName);

      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows <= 0) {
          //if dont exits its going to create it
          $insertStmt = $mysqli->prepare("INSERT INTO $this->table (firstname,lastname,birthdate,nationality) VALUES (?,?,?,?)");
          $insertStmt->bind_param("ssss", $this->firstName, $this->lastName, $this->birthDate, $this->nationality);
          if ($insertStmt->execute()) {

            $platformCreated = (int)$insertStmt->insert_id;  // Platform created successfully
          }
      }

      $stmt->close();
      $mysqli->close();
      return $platformCreated;
    }
    public function updateActor() {
      $platformUpdated = false;
      $mysqli = Database::getDbConnection();

      // Prepare the update statement to prevent SQL injection
      $stmt = $mysqli->prepare("UPDATE $this->table SET firstname=?,lastname=?,birthdate=?,nationality=? WHERE id = ?");
      $stmt->bind_param("ssssi", $this->firstName, $this->lastName, $this->birthDate, $this->nationality, $this->actorId);

      // Execute the statement
      if ($stmt->execute()) {
          // Check if any row was affected (i.e., if the update was successful)
          if ($stmt->affected_rows > 0) {
              $platformUpdated = true;
          }
      }
      $stmt->close();
      $mysqli->close();

      return $platformUpdated;
  }

  public function delete(){
    $deleted = false;
    $mysqli = Database::getDbConnection();

    //prepate statement to Prevent sql injection
    $stmt = $mysqli->prepare("DELETE FROM $this->table WHERE id = ?");
    $stmt->bind_param("i", $this->actorId);

    //execute the statement
    if ($stmt->execute()){
        //check rows
        if($stmt->affected_rows > 0){
            $deleted = true; //record succesfully deleted
        }
    }
    // Close the statement and connection
    $stmt->close();
    $mysqli->close();

    return $deleted;
  }

  }
?>
