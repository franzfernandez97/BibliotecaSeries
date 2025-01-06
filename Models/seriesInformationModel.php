<?php
require_once 'database.php';
require_once 'actorsModel.php';
require_once 'seriesModel.php';
require_once 'directorsModel.php';
require_once 'languagesModel.php';

class SeriesInformation {
    private $actorId;
    private $serieId;
    private $directorId;
    private $lenguajeId;

    public function __construct($seriesId=null,$actorId=null, $directorId=null,$lenguajeId=null) {
      $this->serieId = $seriesId;
      $this->actorId = $actorId;
      $this->directorId = $directorId;
      $this->lenguajeId = $lenguajeId;
    }

    //Getters
    public function getSerieId():int {
        return $this->serieId;
    }

    public function getActorsId():int{
        return $this->actorId;
    }

    public function getDirectorId():int{
        return $this->directorId;
    }

    public function getLenguageId():int{
        return $this->lenguajeId;
    }


    public function getActorsBySerie(): array {
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
          throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
        $query = 'SELECT
                      a.id AS id,
                      a.firstname AS firstname,
                      a.lastname AS lastname,
                      a.birthdate AS birthdate,
                      a.nationality AS nationality
                  FROM
                      series_actors
                  LEFT JOIN actors AS a
                      ON series_actors.idactor = a.id
                  WHERE
                      series_actors.idserie = ?';
        try{
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $this->serieId);
        $stmt->execute();
        $result = $stmt->get_result();
        $actors = [];
        if ($result->num_rows > 0) {
          foreach ($result as $item){
            $itemObject = new Actors(actorId: $item['id'], firstName: $item['firstname'], lastName: $item['lastname'], birthDate: $item['birthdate'], nationality: $item['nationality']);
            array_push($actors, $itemObject);
          }
        }
          }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        $mysqli->close();
        return $actors;
      }

      

      public function getDirectorBySerie(): array {
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
          throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
        $query = 'SELECT
                    d.id AS id,
                    d.firstname AS firstname,
                    d.lastname AS lastname,
                    d.birthdate AS birthdate,
                    d.nationality AS nationality
                    FROM
                      series_directors as sd
                    LEFT JOIN directors as d
                      ON sd.iddirector = d.id
                    WHERE
                      sd.idserie = ?';
        try{
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $this->serieId);
        $stmt->execute();
        $result = $stmt->get_result();


        $directors = [];
        if ($result->num_rows > 0) {
          foreach ($result as $item){
            $itemObject = new Directors($item['id'], $item['firstname'], $item['lastname'], $item['birthdate'], $item['nationality']);
            array_push($directors, $itemObject);
          }
        }
          }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        $mysqli->close();
        return $directors;
      }

      public function getLanguagesBySerie() {
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
          throw new Exception("Error al conectar con la base de datos: ". $mysqli);
      }
        $query = 'SELECT
                    l.id AS id,
                    l.name AS "name",
                    l.isocode AS isocode,
                    ls.languagestype AS "type"
                    FROM
                      languages_series as ls
                    LEFT JOIN languages as l
                      ON ls.idlanguage = l.id
                    WHERE
                      ls.idserie = ?';

        try{
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $this->serieId);
        $stmt->execute();
        $result = $stmt->get_result();


        $languajes = [];
        if ($result->num_rows > 0) {
          foreach ($result as $item){
            $itemObject = [
              "language"=> new Languages($item['id'], $item['name'], $item['isocode']),
              "type"=> $item['type']
            ];
            array_push($languajes, $itemObject);
          }
        }
        }catch (Exception $error) {
          throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
      }
        $mysqli->close();
        return $languajes;
      }

}
    
?>