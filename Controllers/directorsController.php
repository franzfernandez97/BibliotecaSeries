<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/directorsModel.php';

function textValidation($input) {
    return preg_match('/^(?!\s)[\p{L}]+(?:[\p{L}\s]+)*$/u', $input);
}
function dateValidation($input) {
  return preg_match('/^\d{4}-\d{2}-\d{2}$/', $input);
}

function listDirectors():array{

    $model = new Directors();
    try{
      $directorList = $model->getAll();
      foreach ($directorList as $director){
        $director->setBirthDate(date('d/m/Y', strtotime($director->getBirthDate())));
      }
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $directorList;
}

function getDirector($directorId, $view = false){
    $director = new Directors(directorId: $directorId);
    try{
      $directorResult = $director->getById();
      if($view){
        $directorResult->setbirthDate(date('d/m/Y', strtotime($directorResult->getBirthDate())));
      }
    }catch (Exception $error) {
      return $error->getMessage();
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

function updateDirector ($directorId, $firstName, $lastName, $birthDate, $nationality){
    $director = new Directors(directorId: $directorId, firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    try{
      $isEdited = $director->update();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $isEdited;
}

function deleteDirector ($directorId):bool{
    $director = new Directors(directorId: $directorId);
    try{
      $directorDeleted = $director->delete();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $directorDeleted;
  }
?>

