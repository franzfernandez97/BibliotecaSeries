<?php
require_once 'database.php';

class Directors {
    
    private $table = 'directors';
    private $directorId;
    private $firstName;
    private $lastName;
    private $birthDate;
    private $nationality;

    public function __construct($directorId=null, $firstName=null, $lastName=null, $birthDate=null, $nationality=null) {
        $this->directorId = $directorId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->nationality = $nationality;
    }

    //GETTERS
    public function getDirectorId():int {
        return (int)$this->directorId;
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
      public function setDirectorId(int $directorId): void {
        $this->directorId = $directorId;
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

      // READ: Get all directors
      public function getAll():Array {
        $mysqli = Database::getDbConnection();
        $query = "SELECT * FROM $this->table";
        $result = $mysqli->query($query);
        $listData = [];
  
        if ($result->num_rows > 0) {
            foreach ($result as $item){
              $itemObject = new Directors((int)$item['id'], $item['firstname'], $item['lastname'], $item['birthdate'], $item['nationality']);
              array_push($listData, $itemObject);
            }
        }
        $mysqli->close();
        return $listData;
      }

    // READ: Get a specific Directors by ID
    public function getById(){
        $mysqli = Database::getDbConnection();
        $query = 'SELECT * FROM directors WHERE id = ?';
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $this->directorId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
          foreach ($result as $item){
              $itemObject = new Directors($item["id"], $item["firstname"], $item['lastname'], $item['birthdate'], nationality: $item['nationality']);
              return $itemObject;
          }
        }
        $mysqli->close();
        return false;
      }

    // CREATE: Add a new Directors
    public function create(){
        $directorCreated = false;
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
  
              $directorCreated = (int)$insertStmt->insert_id;  // Platform created successfully
            }
        }
  
        $stmt->close();
        $mysqli->close();
        return $directorCreated;
      }

    // UPDATE: Update an existing Directors by ID
    public function update() {
        $directorUpdated = false;
        $mysqli = Database::getDbConnection();
  
        // Prepare the update statement to prevent SQL injection
        $stmt = $mysqli->prepare("UPDATE $this->table SET firstname=?,lastname=?,birthdate=?,nationality=? WHERE id = ?");
        $stmt->bind_param("ssssi", $this->firstName, $this->lastName, $this->birthDate, $this->nationality, $this->directorId);
  
        // Execute the statement
        if ($stmt->execute()) {
            // Check if any row was affected (i.e., if the update was successful)
            if ($stmt->affected_rows > 0) {
                $directorUpdated = true;
            }
        }
        $stmt->close();
        $mysqli->close();
  
        return $directorUpdated;
    }
    
    // DELETE: Delete a Directors by ID
    public function delete(){
      $deleted = false;
      $mysqli = Database::getDbConnection();
  
      //prepate statement to Prevent sql injection
      $stmt = $mysqli->prepare("DELETE FROM $this->table WHERE id = ?");
      $stmt->bind_param("i", $this->directorId);
  
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
