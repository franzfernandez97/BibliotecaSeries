<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/seriesInformationModel.php';

  
  function listActorsBySerie($serieId):array {
    $model = new SeriesInformation(seriesId: $serieId);
    try{
    $actorsList = $model->getActorsBySerie();
  }catch (Exception $error) {
    throw new Exception($error->getMessage());
}
    return $actorsList;
  }

  function listDirectorsBySerie($serieId):array{
    $model = new SeriesInformation(seriesId: $serieId);
    try{
    $directorsList = $model->getDirectorBySerie();
      }catch (Exception $error) {
        throw new Exception($error->getMessage());
    }
    return $directorsList;

  }

  function listLanguagesBySerie($serieId){
    $model = new SeriesInformation(seriesId: $serieId);
    try{
    $languagesList = $model->getLanguagesBySerie();
      }catch (Exception $error) {
        throw new Exception($error->getMessage());
    }
    return $languagesList;

  }


?>
