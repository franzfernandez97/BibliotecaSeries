<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/actorSeriesModel.php';

  function listActorsBySerie($serieId):array {
    $model = new ActorSeries(seriesId: $serieId);
    $actorsList = $model->getActorsBySerie();
    return $actorsList;
  }
  function listSeriesByActor(int $actorId):array {
    $model = new ActorSeries(actorId: $actorId);
    $seriesList = $model->getSeriesByActors();
    return $seriesList;
  }
  function addActorToSeries($actorId, $series):void {
    $model = new ActorSeries(actorId: $actorId);
    $model->addActorToSeries(actorId: $actorId, series: $series);
  }
  function updateActorSeries($actorId, $seriesId):void {
    $model = new ActorSeries(actorId: $actorId);
    $model->updateActorSeries(actorId: $actorId, seriesId: $seriesId);
  }

?>
