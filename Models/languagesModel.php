<?php
require_once 'database.php';

class Languages {
    private $languageId;
    private $languageName;
    private $languageCode;
    private $table = 'languages';

    public function __construct($languageId = null, $languageName = null, $languageCode = null) {
      $this->languageId = $languageId;
      $this->languageName = $languageName;
      $this->languageCode = $languageCode;
    }
    //GETTERS
    public function getLanguageId():int {
      return (int)$this->languageId;
    }
    public function getLanguageName():string {
      return (string)$this->languageName;
    }
    public function getLanguageCode():string {
      return (string)$this->languageCode;
    }
    //SETTERS
    public function setLanguageId(int $languageId): void {
      $this->languageId = $languageId;
    }
    public function setLanguageName(string $languageName): void {
      $this->languageName = $languageName;
    }
    public function setLanguageCode(string $languageCode):void {
      $this->languageCode = $languageCode;
    }
    public function getAllLanguages(): array{
      $mysqli = Database::getDbConnection();
      // Get the error message from the database connection
      if(is_string($mysqli)){
        throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
      $query = "SELECT * FROM $this->table";
      // Get the error message from the query
      try {
        $result = $mysqli->query(query: $query);
      }catch (Exception $error) {
        throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
      }
      $languages = [];
      if ($result->num_rows > 0) {
        foreach ($result as $result_array) {
          $itemObject = new Languages(languageId: $result_array['id'], languageName: $result_array['name'], languageCode: $result_array['isocode']);
          array_push($languages, $itemObject);
        }
      }
      $mysqli->close();
      return $languages;
    }
    public function getById()  {
      $mysqli = Database::getDbConnection();
      if(is_string($mysqli)){
        throw new Exception("Error al conectar con la base de datos: " . $mysqli);
      }
      $query = 'SELECT * FROM languages WHERE id = ?';
      try {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $this->languageId);
        $stmt->execute();
        $result = $stmt->get_result();
      }catch (Exception $error) {
        throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
      }
      if ($result->num_rows > 0 ){
        foreach ($result as $result_array) {
          $itemObject = new Languages(languageId: $result_array['id'], languageName: $result_array['name'], languageCode: $result_array['isocode']);
          $stmt->close();
          $mysqli->close();
          return $itemObject;
        }
      }
      $stmt->close();
      $mysqli->close();
      return false;
    }
    public function createLanguage(): bool {
      $mysqli = Database::getDbConnection();
      if(is_string($mysqli)){
        throw new Exception("Error al conectar con la base de datos: " . $mysqli);
      }
      $query = "INSERT INTO $this->table (name, isocode) VALUES (?, ?)";
      try {
        $resultQuery =$this->getByCode();
        if ($resultQuery){
          throw new Exception("El idioma ya existe");
        }
    } catch (Exception $error) {
        throw new Exception("" . $error->getMessage());

    }
      // if ($repeat) {
      //   throw new Exception("¡El idioma ya existe!");
      // }
      try {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $this->languageId, $this->languageCode);
        $stmt->execute();
        $result = $stmt->get_result();
      }catch (Exception $error) {
        throw new Exception("Error al tratar de crear el idioma: " . $error->getMessage());
      }
      $stmt->close();
      $mysqli->close();
      return $result ? true : false;
    }
    public function editlanguage(){
      $mysqli = Database::getDbConnection();
      if (is_string($mysqli)) {
        throw new Exception("Error al conectar con la base de datos: " . $mysqli);
      }
      $query = "UPDATE $this->table SET name = ?, isocode = ? WHERE id = ?";
      try {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssi", $this->languageName, $this->languageCode, $this->languageId);
        $stmt->execute();
        $result = $stmt->get_result();
      }catch(Exception $error) {
        throw new Exception("Error al editar el idioma: ". $error->getMessage());
      }
      $stmt->close();
      $mysqli->close();
      return $result ? true : false;
    }
    public function deletelanguage(){
      $mysqli = Database::getDbConnection();
      if (is_string($mysqli)) {
        throw new Exception("Error al conectar con la base de datos: " . $mysqli);
      }
      $query = "DELETE FROM $this->table WHERE id = ?";
      try {
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $this->languageId);
        $result = $stmt->execute();
        $stmt->close();
        $mysqli->close();
        return $result ? true : false;
      }catch(Exception $error) {
        throw new Exception("Error al borrar el idioma: ". $error->getMessage());
      }

    }
    public function getByCode() {
      $mysqli = Database::getDbConnection();
      if (is_string($mysqli)) {
          throw new Exception("Error al conectar con la base de datos: " . $mysqli);
      }

      // Preparar la consulta para verificar si el idioma existe
      $query = "SELECT * FROM $this->table WHERE LOWER(isocode) = LOWER(?)";
      try {
          $stmt = $mysqli->prepare($query);
          $stmt->bind_param('s', $this->languageCode);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
              $stmt->close();
              $mysqli->close();
              return true;
          }
          $stmt->close();
          $mysqli->close();
          return false;
      } catch (Exception $error) {
          throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
      }
    }
}

?>
