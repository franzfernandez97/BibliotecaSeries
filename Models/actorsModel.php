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
      if(is_string($mysqli)){
        throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
      $query = "SELECT * FROM $this->table";
      try {
        $result = $mysqli->query($query);
      }catch (Exception $error) {
        throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
      }
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
      if(is_string($mysqli)){
        throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
      $query = "SELECT * FROM $this->table WHERE id = ?";
      try {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $this->actorId);
        $stmt->execute();
        $result = $stmt->get_result();
      }catch (Exception $error) {
        throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
      }

      if ($result->num_rows > 0){
        foreach ($result as $item){
            $itemObject = new Actors($item["id"], $item["firstname"], $item['lastname'], $item['birthdate'], nationality: $item['nationality']);
            return $itemObject;
        }
      }
      $stmt->close();
      $mysqli->close();
      return false;
    }

    public function createActor(){
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
        $platformCreated = (int)$insertStmt->insert_id;
      }catch (Exception $error) {
        throw new Exception("Error al tratar de crear el actor: " . $error->getMessage());
      }
      $insertStmt->close();
      $mysqli->close();
      return $result ? $platformCreated : false;
    }
    public function updateActor() {
      $mysqli = Database::getDbConnection();
      if(is_string($mysqli)){
        throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
      try {
        $stmt = $mysqli->prepare("UPDATE $this->table SET firstname=?,lastname=?,birthdate=?,nationality=? WHERE id = ?");
        $stmt->bind_param("ssssi", $this->firstName, $this->lastName, $this->birthDate, $this->nationality, $this->actorId);
        $stmt->execute();
        $result = $stmt->get_result();
      }catch(Exception $error) {
        throw new Exception("Error al editar el actor: ". $error->getMessage());
      }
      $stmt->close();
      $mysqli->close();
      return $result ? true : false;
  }

    public function delete(){
    $deleted = false;
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    try {
      $stmt = $mysqli->prepare("DELETE FROM $this->table WHERE id = ?");
      $stmt->bind_param("i", $this->actorId);
      $result = $stmt->execute();
      $stmt->close();
      $mysqli->close();
      return $result ? true : false;
    }catch(Exception $error) {
      throw new Exception("Error al borrar el actor: ". $error->getMessage());
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
