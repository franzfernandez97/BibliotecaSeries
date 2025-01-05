<?php
require_once 'database.php';
require_once 'directorsModel.php';
require_once 'seriesModel.php';

class DirectorSeries {
  private $directorId;
  private $serieId;
  public function __construct($directorId=null, $seriesId=null) {
    $this->directorId = $directorId;
    $this->serieId = $seriesId;
  }
  //GETTERS
  public function getDirectorId():int {
    return $this->directorId;
  }
  public function getSerieId():int {
    return $this->serieId;
  }
  //SETTERS
  public function setDirectorId($directorId):void {
    $this->directorId = $directorId;
  }
  public function setSerieId($serieId):void {
    $this->serieId = $serieId;
  }
  public function getDirectorsBySerie(): array {
    $mysqli = Database::getDbConnection();
    $query = 'SELECT
                directors.id AS directorId,
                directors.firstname AS directorFirstName,
                directors.lastname AS directorLastName,
                directors.birthdate AS directorBirthDate,
                directors.nationality AS directorNationality
                FROM
                  series_directors
                LEFT JOIN
                  directors ON series_directors.iddirector= directors.id
                WHERE
                  series_directors.idserie = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $this->serieId);
    $stmt->execute();
    $result = $stmt->get_result();
    $directors = [];
    if ($result->num_rows > 0) {
      foreach ($result as $item){
        $itemObject = new Directors(directorId: $item['id'], firstName: $item['firstname'], lastName: $item['lastname'], birthDate: $item['birthdate'], nationality: $item['nationality']);
        array_push(array: $directors, values: $itemObject);
      }
    }
    $mysqli->close();
    return $directors;
  }
  public function getSeriesByDirector(): array {
    $mysqli = Database::getDbConnection();
    $query = 'SELECT
                series.id AS serieId,
                series.title AS serieTitle,
                series.platformid AS seriesPlatform
                FROM
                  series_directors
                LEFT OUTER JOIN
                  series ON series_directors.idserie = series.id
                WHERE
                  series_directors.iddirector = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $this->directorId);
    $stmt->execute();
    $result = $stmt->get_result();
    $series = [];
    if ($result->num_rows > 0) {
      foreach ($result as $item){
        $itemObject = new Series(idSeries: $item['serieId'], titleSeries: $item['serieTitle'], idPlatform: $item['seriesPlatform']);
        array_push($series,$itemObject);
      }
    }
    $mysqli->close();
    return $series;
  }
  public function addDirectorToSeries($directorId, array $series): void {
    $mysqli = Database::getDbConnection();
    $query = 'INSERT INTO series_directors (iddirector, idserie) VALUES (?, ?)';
    foreach ($series as $serie) {
      $smtm = $mysqli->prepare($query);
      $smtm->bind_param('ii', $directorId, $serie);
      $smtm->execute();
    }
  }
  public function updateDirectorSeries(int $directorId, array $seriesId) {
    $mysqli = Database::getDbConnection();
    $query = 'DELETE FROM series_directors WHERE iddirector = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $directorId);
    $stmt->execute();
    $queryInsert = 'INSERT INTO series_directors (iddirector, idserie) VALUES (?, ?)';
    $stmtInsert = $mysqli->prepare($queryInsert);
    foreach ($seriesId as $serieId) {
      $stmtInsert->bind_param('ii', $directorId, $serieId);
      $stmtInsert->execute();
    }

  }
}

?>
