<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/directorsModel.php';

function textValidation($input) {
    return preg_match('/^(?!\s)[\p{L}]+(?:[\p{L}\s]+)*$/u', $input);
}

function listDirectors():array{

    $model = new Directors();
    $directorList = $model->getAll();
    foreach ($directorList as $director){
      $director->setBirthDate(date('d/m/Y', strtotime($director->getBirthDate())));
    }
    return $directorList;
}

function getDirector($directorId, $view = false){
    $director = new Directors(directorId: $directorId);
    $directorResult = $director->getById();
    if($view){
      $directorResult->setbirthDate(date('d/m/Y', strtotime($directorResult->getBirthDate())));
    }
    return $directorResult;
  }

function createDirector($firstName, $lastName, $birthDate, $nationality){

    if (func_num_args() !== 4) {
      throw new Exception("Error funcion createDirector: Se requiere llenar todos los parametros.");
    }
    if (!textValidation($firstName) || !textValidation($lastName) || !dateValidation($birthDate) || !textValidation($nationality)) {
      return "Error funcion createDirector: Los parametros no pueden ser numeros ni caracteres especiales.";
    }
    $newDirector = new Directors(firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    try{
      $isCreated = $newDirector->create();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $isCreated;
}

function updateDirector ($directorId, $firstName, $lastName, $birthDate, $nationality):bool{
    $director = new Directors(directorId: $directorId, firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    $isEdited = $director->update();
    return $isEdited;
}

function deleteDirector ($directorId):bool{
    $director = new Directors(directorId: $directorId);
    $directorDeleted = $director->delete();
    return $directorDeleted;
  }


?>

