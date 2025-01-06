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
        //$directorCreated = false;
        $mysqli = Database::getDbConnection();
        if(is_string($mysqli)){
          throw new Exception("Error al conectar con la base de datos: ". $mysqli);
        }

        try {
          $resultDuplicate = $this->getDuplicate();
          if ($resultDuplicate){
            throw new Exception("El actor ya existe");
          }
        } catch (Exception $error) {
          throw new Exception("" . $error->getMessage());
        }
  
        try {
          $insertStmt = $mysqli->prepare("INSERT INTO $this->table (firstname,lastname,birthdate,nationality) VALUES (?,?,?,?)");
          $insertStmt->bind_param("ssss", $this->firstName, $this->lastName, $this->birthDate, $this->nationality);
          $result = $insertStmt->execute();
          $directorCreated = (int)$insertStmt->insert_id;
        }catch (Exception $error) {
          throw new Exception("Error al tratar de crear el director: " . $error->getMessage());
        }
        $insertStmt->close();
        $mysqli->close();
        return $result ? $directorCreated : false;
      }

    // UPDATE: Update an existing Directors by ID
    public function update() {
      $mysqli = Database::getDbConnection();
      if(is_string($mysqli)){
        throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
      try {
        $stmt = $mysqli->prepare("UPDATE $this->table SET firstname=?,lastname=?,birthdate=?,nationality=? WHERE id = ?");
        $stmt->bind_param("ssssi", $this->firstName, $this->lastName, $this->birthDate, $this->nationality, $this->directorId);
        $stmt->execute();
        $result = $stmt->get_result();
      }catch(Exception $error) {
        throw new Exception("Error al editar el director: ". $error->getMessage());
      }
      $stmt->close();
      $mysqli->close();
      return $result ? true : false;
  }
    
  public function delete(){
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    try {
      $stmt = $mysqli->prepare("DELETE FROM $this->table WHERE id = ?");
      $stmt->bind_param("i", $this->directorId);
      $result = $stmt->execute();
      $stmt->close();
      $mysqli->close();
      return $result ? true : false;
    }catch(Exception $error) {
      throw new Exception("Error al borrar el director: ". $error->getMessage());
    }
  }

    public function getDuplicate() {
      $mysqli = Database::getDbConnection();
      if(is_string($mysqli)){
        throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
      $query = "SELECT * FROM $this->table WHERE LOWER(firstname) = LOWER(?) AND LOWER(lastname) = LOWER(?)";
      try {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $this->firstName,$this->lastName);
        $stmt->execute();
        $result = $stmt->get_result();
      }catch (Exception $error) {
        throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
      }
      if ($result->num_rows > 0){
        $stmt->close();
        $mysqli->close();
        return true;
      }
      $stmt->close();
      $mysqli->close();
      return false;
    }
  
    }
  ?>
