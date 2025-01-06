<?php
require_once 'database.php';

require_once 'languagesModel.php';
require_once 'seriesModel.php';
class LanguageSeries {
  private $table = "languages_series";
  private $languageId;
  private $serieId;
  private $languageType;
  public function __construct($languageId = null, $serieId = null, $languageType = null) {
    $this->languageId = $languageId;
    $this->serieId = $serieId;
    $this->languageType = $languageType;
  }
  //GETTERS
  public function getLanguageId():int {
    return (int)$this->languageId;
  }
  public function getSerieId():int {
    return (int)$this->serieId;
  }
  public function getLanguageType():string {
    return (string)$this->languageType;
  }
  //SETTERS
  public function setLanguageId($languageId):void {
    $this->languageId = (int)$languageId;
  }
  public function setSerieId($serieId):void {
    $this->serieId = (int)$serieId;
  }
  public function setLanguageType($languageType):void {
    $this->languageType = (string)$languageType;
  }
  public function getLanguagesBySerie() {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "SELECT
                languages.id AS languageId,
                languages.name AS languageName,
                languages.isocode AS languageIsoCode,
                languages_series.languagestype AS languageType
                FROM
                  $this->table
                LEFT JOIN
                  languages ON languages_series.idlanguage = languages.id
                WHERE
                  languages_series.idserie = ?";
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("i", $this->serieId);
      $stmt->execute();
      $result = $stmt->get_result();
    }catch (Exception $error) {
      throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
    }
    $languages = [];
    if ($result->num_rows > 0) {
      foreach ($result as $item){
        $itemObject = [
          'language'=> new Languages(languageId: $item['languageId'], languageName: $item['languageName'], languageCode: $item['languageIsoCode']),
          'languageType' => new LanguageSeries(languageType:$item['languageType'])
          ];
        array_push( $languages, $itemObject);
      }
    }
    $stmt->close();
    $mysqli->close();
    return $languages;
  }
  public function getSeriesByLanguage() {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "SELECT
                series.id AS serieId,
                series.title AS serieTitle,
                series.platformid AS seriesPlatform,
                languages_series.languagestype AS languageType
                FROM
                  $this->table
                LEFT JOIN
                  series ON languages_series.idserie = series.id
                WHERE
                  languages_series.idlanguage = ?";
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("i", $this->languageId);
      $stmt->execute();
      $result = $stmt->get_result();
    }catch (Exception $error) {
      throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
    }
    $series = [];
    if ($result->num_rows > 0) {
      foreach ($result as $item){
        $itemObject = [
          'serie' => new Series(idSeries: $item['serieId'], titleSeries: $item['serieTitle'], idPlatform: $item['seriesPlatform']),
          'languageType' => new LanguageSeries(languageType:$item['languageType'])
        ];
        array_push($series,$itemObject);
      }
    }
    $stmt->close();
    $mysqli->close();
    return $series;
  }
  public function getSeriesAudio(){
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "SELECT
                series.id AS serieId,
                series.title AS serieTitle,
                series.platformid AS seriesPlatform
                FROM
                  $this->table
                LEFT JOIN
                  series ON languages_series.idserie = series.id
                WHERE
                  languages_series.idlanguage = ?
                  AND
                  languages_series.languagestype = 'audio'" ;
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("i", $this->languageId);
      $stmt->execute();
      $result = $stmt->get_result();
    }catch (Exception $error) {
      throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
    }
    $series = [];
    if ($result->num_rows > 0) {
      foreach ($result as $item){
        $itemObject = new Series(idSeries: $item['serieId'], titleSeries: $item['serieTitle'], idPlatform: $item['seriesPlatform']);
        array_push($series,$itemObject);
      }
    }
    $stmt->close();
    $mysqli->close();
    return $series;
  }
  public function getSeriesSubtitle(){
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "SELECT
                series.id AS serieId,
                series.title AS serieTitle,
                series.platformid AS seriesPlatform
                FROM
                  $this->table
                LEFT JOIN
                  series ON languages_series.idserie = series.id
                WHERE
                  languages_series.idlanguage = ?
                  AND
                  languages_series.languagestype = 'subtitle'" ;
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("i", $this->languageId);
      $stmt->execute();
      $result = $stmt->get_result();
    }catch (Exception $error) {
      throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
    }
    $series = [];
    if ($result->num_rows > 0) {
      foreach ($result as $item){
        $itemObject = new Series(idSeries: $item['serieId'], titleSeries: $item['serieTitle'], idPlatform: $item['seriesPlatform']);
        array_push($series,$itemObject);
      }
    }
    $stmt->close();
    $mysqli->close();
    return $series;
  }
  public function deleteLanguageRelationship() {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "DELETE FROM $this->table WHERE idlanguage = ?";
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $this->languageId);
      $result = $stmt->execute();
    }catch (Exception $error) {
      throw new Exception("Error al tratar eliminar el lenguaje de la serie: " . $error->getMessage());
    }
    return $result ? true : false;
  }
  public function addRelationship(array $seriesId, array $languageTypes) {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "INSERT INTO $this->table (idlanguage, idserie, languagestype) VALUES (?, ?, ?)";
    try {
      foreach($seriesId as $serie) {
        foreach($languageTypes as $languageType) {
          $stmt = $mysqli->prepare($query);
          $stmt->bind_param("iis", $this->languageId, $serie, $languageType);
          $stmt->execute();
        }
      }
      $stmt->close();
      $mysqli->close();
    }catch (Exception $error) {
      throw new Exception("Error al tratar eliminar el lenguaje de la serie: " . $error->getMessage());
    }

  }

  public function updateRelationship(array $seriesId, array $languagesType) {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "DELETE FROM $this->table WHERE idlanguage = ?";
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $this->languageId);
      $stmt->execute();
    }catch (Exception $error) {
      throw new Exception("Error al tratar eliminar el idioma de la serie: " . $error->getMessage());
    }
    $insertQuery = "INSERT INTO $this->table (idlanguage, idserie, languagestype) VALUES (?, ?, ?)";

    try {
      $stmtInsert = $mysqli->prepare($insertQuery);
      foreach ($seriesId as $serieId){
        foreach ($languagesType as $languageType){
          $stmtInsert->bind_param("iis", $this->languageId, $serieId, $languageType);
          $stmtInsert->execute();
        }
      }
      $stmtInsert->close();
      $mysqli->close();
    }catch (Exception $error) {
      throw new Exception("Error al tratar agregar el idioma a la serie: " . $error->getMessage());
    }
  }

  public function deleteSerieRelationship() {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "DELETE FROM $this->table WHERE idserie = ?";
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $this->serieId);
      $result = $stmt->execute();
    }catch (Exception $error) {
      throw new Exception("Error al tratar eliminar el lenguaje de la serie: " . $error->getMessage());
    }
    return $result ? true : false;
  }
  public function deleteRelationship(array $seriesId, array $languagesType) {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = "DELETE FROM $this->table WHERE idserie = ?";
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $this->serieId);
      $stmt->execute();
      $stmt->close();
    }catch (Exception $error) {
      throw new Exception("Error al tratar eliminar el idioma de la serie: " . $error->getMessage());
    }

  }

}

?>
