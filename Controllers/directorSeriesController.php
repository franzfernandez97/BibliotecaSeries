<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/directorSeriesModel.php';

  function listDirectorsBySerie($serieId):array {
    $model = new DirectorSeries(seriesId: $serieId);
    $directorsList = $model->getDirectorsBySerie();
    return $directorsList;
  }
  function listSeriesByDirector(int $directorId):array {
    $model = new DirectorSeries(directorId: $directorId);
    $seriesList = $model->getSeriesByDirector();
    return $seriesList;
  }
  function addDirectorToSeries($directorId, $series):void {
    $model = new DirectorSeries(directorId: $directorId);
    $model->addDirectorToSeries(directorId: $directorId, series: $series);
  }
  function updateDirectorSeries($directorId, $seriesId):void {
    $model = new DirectorSeries(directorId: $directorId);
    $model->updateDirectorSeries(directorId: $directorId, seriesId: $seriesId);
  }

?>
