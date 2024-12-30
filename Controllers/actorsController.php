<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/actorsModel.php';

  function listActors():array {
    $model = new Actors();
    $actorsList = $model->getAll();
    foreach ($actorsList as $actor) {
      $actor->setBirthDate(date('d/m/Y', strtotime($actor->getBirthDate())));
    }
    return $actorsList;
  }
  function getActor($actorId, $view = false){
    $actor = new Actors(actorId: $actorId);
    $actorResult = $actor->getById();
    if($view){
      $actorResult->setbirthDate(date('d/m/Y', strtotime($actorResult->getBirthDate())));
    }
    return $actorResult;
  }
  function createActor ($firstName, $lastName, $birthDate, $nationality):bool|int{
    $newActor = new Actors(firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    $isCreated = $newActor->createActor();
    return $isCreated;
  }
  function updateActor ($actorId, $firstName, $lastName, $birthDate, $nationality):bool{
    $model = new Actors(actorId: $actorId, firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    $isEdited = $model->updateActor();
    return $isEdited;
  }
  function deleteActor ($actorId):bool{
    $actor = new Actors(actorId: $actorId);
    $actorDeleted = $actor->delete();
    return $actorDeleted;
  }

?>
