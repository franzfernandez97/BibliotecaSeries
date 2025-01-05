<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/seriesInformationModel.php';

  
  function listPlatformBySerie($serieId):array{
    $model = new SeriesInformation(seriesId: $serieId);
    $platformList = $model->getPlatformBySerie();
    return $platformList;

  }


  function listActorsBySerie($serieId):array {
    $model = new SeriesInformation(seriesId: $serieId);
    $actorsList = $model->getActorsBySerie();
    return $actorsList;
  }

  function listDirectorsBySerie($serieId):array{
    $model = new SeriesInformation(seriesId: $serieId);
    $directorsList = $model->getDirectorBySerie();
    return $directorsList;

  }

  function listLanguagesBySerie($serieId){
    $model = new SeriesInformation(seriesId: $serieId);
    $languagesList = $model->getLanguagesBySerie();
    return $languagesList;

  }


?>
