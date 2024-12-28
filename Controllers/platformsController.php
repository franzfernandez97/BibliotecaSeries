<?php
require_once "../../models/platformsModel.php";

function listPlatforms(){
    //check no arguments were used
    if (func_num_args()> 0){
        throw new InvalidArgumentException( "Error función listPlatforms: no acepta parametros");
    }
    $model = new Platform(null, null);
    $plataformList = $model->getAll();
    return $plataformList;
}


function createPlatform ($namePlatform){
    //check if pass different arguments than 1
    if (func_num_args() !== 1) {
        throw new InvalidArgumentException("Error funcion createPlatform: requiere exactamente 1 parametro.");
    }

    // the argument is string?
    if (!is_string($namePlatform)) {
        throw new InvalidArgumentException("Error funcion createPlatform: parametro namePlatform debe ser una cadena (string).");
    }

    $newPlatform = new Platform(null, $namePlatform);
    $isCreated = $newPlatform->create();
    return $isCreated ;
}

function updatePlatform ($idPlatform, $namePlatform){
    //check if pass different arguments than 1
    if (func_num_args() !== 2) {
        throw new InvalidArgumentException("Error funcion updatePlatform: requiere exactamente 2 parametros.");
    }

    // is $idPlatform an INT?
    if (!is_int($idPlatform)) {
        throw new InvalidArgumentException("Error funcion updatePlatform: parametro 'idPlatform' debe ser un número entero (int).");
    }

    // is $namePlatform a string?
    if (!is_string($namePlatform)) {
        throw new InvalidArgumentException("Error funcion updatePlatform: parametro 'namePlatform' debe ser una cadena (string).");
    }
    $model = new Platform($idPlatform, $namePlatform);
    $isEdited = $model->update();
    return $isEdited ;
}

function getPlatformData($idPlatform){
    //check if pass different arguments than 1
    if (func_num_args() !== 1) {
        throw new InvalidArgumentException("Error funcion getPlatformData: requiere exactamente 1 parametro.");
    }

    // is $idPlatform an INT?
    if (!is_int($idPlatform)) {
        throw new InvalidArgumentException("Error funcion getPlatformData: parametro 'idPlatform' debe ser un número entero (int).");
    }
    $platform = new Platform($idPlatform,null);
    $platformObject = $platform->getItem();
    return $platformObject; 
}

function deletePlatform ($idPlatform){
    //check if pass different arguments than 1
    if (func_num_args() !== 1) {
        throw new InvalidArgumentException("Error funcion deletePlatform: requiere exactamente 1 parametro.");
    }

    // is $idPlatform an INT?
    if (!is_int($idPlatform)) {
        throw new InvalidArgumentException("Error funcion deletePlatform: parametro 'idPlatform' debe ser un número entero (int).");
    }
    $platform = new Platform($idPlatform,null);
    $platformDeleted = $platform->delete();
    return $platformDeleted;
}

function getPlatformIdByName($platformName){
    //check if pass different arguments than 1
    if (func_num_args() !== 1) {
        throw new InvalidArgumentException("Error funcion getPlatformIdByName: requiere exactamente 1 parametro.");
    }

    // is $platformName an INT?
    if (!is_string($platformName)) {
        throw new InvalidArgumentException("Error funcion getPlatformIdByName: parametro 'platformName' debe ser un número entero (str).");
    }
    $platform = new Platform(null,$platformName);
    $platformObject = $platform->getItemByName();
    return $platformObject; 
}

?>

