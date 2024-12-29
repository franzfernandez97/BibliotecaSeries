<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/actorsModel.php';

  function listActors():array {
    $model = new Actors();
    $actorsList = $model->getAll();
    return $actorsList;
  }
  function getActor($actorId){
    $actor = new Actors(actorId: $actorId);
    $actorResult = $actor->getById();
    return $actorResult;
  }
  function createActor ($firstName, $lastName, $birthDate, $nationality):bool{
    $newActor = new Actors(firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    $isCreated = $newActor->createActor();
    return $isCreated;
  }
  function updatePlatform ($actorId, $firstName, $lastName, $birthDate, $nationality):bool{
    $model = new Actors(actorId: $actorId, firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    $isEdited = $model->updateActor();
    return $isEdited;
  }
  function deletePlatform ($actorId):bool{
    $actor = new Actors(actorId: $actorId);
    $actorDeleted = $actor->delete();
    return $actorDeleted;
  }

?>
