<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/directorsModel.php';

function listDirectors(){
    //check no arguments were used
    if (func_num_args()> 0){
        throw new InvalidArgumentException( "Error función listDirectors: no acepta parametros");
    }
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

function createDirector($firstName, $lastName, $birthDate, $nationality):bool|int{

    $newDirector = new Directors(firstName: $firstName, lastName: $lastName, birthDate: $birthDate, nationality: $nationality);
    $isCreated = $newDirector->create();
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

