<?php
require_once 'database.php';
require_once 'actorsModel.php';
require_once 'seriesModel.php';
class ActorSeries {
  private $actorId;
  private $serieId;
  public function __construct($actorId=null, $seriesId=null) {
    $this->actorId = $actorId;
    $this->serieId = $seriesId;
  }
  //GETTERS
  public function getActorId():int {
    return $this->actorId;
  }
  public function getSerieId():int {
    return $this->serieId;
  }
  //SETTERS
  public function setActorId($actorId):void {
    $this->actorId = $actorId;
  }
  public function setSerieId($serieId):void {
    $this->serieId = $serieId;
  }
  public function getActorsBySerie(): array {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = 'SELECT
                actors.id AS actorId,
                actors.firstname AS actorFirstName,
                actors.lastname AS actorLastName,
                actors.birthdate AS actorBirthDate,
                actors.nationality AS actorsNationality
                FROM
                  series_actors
                LEFT JOIN
                  actors ON series_actors.idactor = actors.id
                WHERE
                  series_actors.idserie = ?';
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("i", $this->serieId);
      $stmt->execute();
      $result = $stmt->get_result();
    }catch (Exception $error) {
      throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
    }
    $actors = [];
    if ($result->num_rows > 0) {
      foreach ($result as $item){
        $itemObject = new Actors(actorId: $item['id'], firstName: $item['firstname'], lastName: $item['lastname'], birthDate: $item['birthdate'], nationality: $item['nationality']);
        array_push(array: $actors, values: $itemObject);
      }
    }
    $stmt->close();
    $mysqli->close();
    return $actors;
  }
  public function getSeriesByActors(): array {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = 'SELECT
                series.id AS serieId,
                series.title AS serieTitle,
                series.platformid AS seriesPlatform
                FROM
                  series_actors
                LEFT OUTER JOIN
                  series ON series_actors.idserie = series.id
                WHERE
                  series_actors.idactor = ?';
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param("i", $this->actorId);
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
  public function addActorToSeries($actorId, array $series): void {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = 'INSERT INTO series_actors (idactor, idserie) VALUES (?, ?)';
    try {
      foreach ($series as $serie) {
        $smtm = $mysqli->prepare($query);
        $smtm->bind_param('ii', $actorId, $serie);
        $smtm->execute();
      }
      $smtm->close();
      $mysqli->close();
    }catch (Exception $error) {
      throw new Exception("Error al tratar de agregar actor a la serie: " . $error->getMessage());
    }
  }
  public function updateActorSeries(int $actorId, array $seriesId) {
    $mysqli = Database::getDbConnection();
    if(is_string($mysqli)){
      throw new Exception("Error al conectar con la base de datos: ". $mysqli);
    }
    $query = 'DELETE FROM series_actors WHERE idactor = ?';
    try {
      $stmt = $mysqli->prepare($query);
      $stmt->bind_param('i', $actorId);
      $stmt->execute();
    }catch (Exception $error) {
      throw new Exception("Error al tratar eliminar actor de la serie: " . $error->getMessage());
    }
    $queryInsert = 'INSERT INTO series_actors (idactor, idserie) VALUES (?, ?)';
    $stmtInsert = $mysqli->prepare($queryInsert);
    foreach ($seriesId as $serieId) {
      $stmtInsert->bind_param('ii', $actorId, $serieId);
      $stmtInsert->execute();
    }

  }
}

?>
