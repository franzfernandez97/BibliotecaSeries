<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/actorsModel.php';

  function textValidation($input) {
    return preg_match('/^(?!\s)[\p{L}]+(?:[\p{L}\s]+)*$/u', $input);
  }
  function dateValidation($input) {
    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $input);
  }
  function listActors() {
    $model = new Actors();
    try {
      $actorsList = $model->getAll();
      foreach ($actorsList as $actor) {
        $actor->setBirthDate(date('d/m/Y', strtotime($actor->getBirthDate())));
      }
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $actorsList;
  }

  function getActor($actorId, $view = false){
    $actor = new Actors(actorId: $actorId);
    try {
      $actorResult = $actor->getById();
      if($view){
        $actorResult->setbirthDate(date('d/m/Y', strtotime($actorResult->getBirthDate())));
      }
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $actorResult;
  }
  function createActor ($firstName, $lastName, $birthDate, $nationality){
    if (func_num_args() !== 4) {
      throw new Exception("Error funcion createDirector: Se requiere llenar todos los parametros.");
    }
    if (!textValidation($firstName) || !textValidation($lastName) || !dateValidation($birthDate) || !textValidation($nationality)) {
      return "Error funcion createSerie: Los parametros no pueden ser numeros ni caracteres especiales.";
    }
    $newActor = new Actors(firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    try {
      $isCreated = $newActor->createActor();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $isCreated;
  }
  function updateActor ($actorId, $firstName, $lastName, $birthDate, $nationality){
    $model = new Actors(actorId: $actorId, firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    try {
      $isEdited = $model->updateActor();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $isEdited;
  }
  function deleteActor ($actorId){
    $actor = new Actors(actorId: $actorId);
    try {
      $actorDeleted = $actor->delete();
      return $actorDeleted;
    }catch (Exception $error) {
      return $error->getMessage();
    }
  }

?>
