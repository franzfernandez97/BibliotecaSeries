<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/actorsModel.php';

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

?>
