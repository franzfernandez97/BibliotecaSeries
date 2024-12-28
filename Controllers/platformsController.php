<?php
require_once "../../models/platformsModel.php";

function listPlatforms(){
    $model = new Platform(null, null);
    $plataformList = $model->getAll();
    return $plataformList;
}

function createPlatform ($namePlatform){
    $newPlatform = new Platform(null, $namePlatform);
    $isCreated = $newPlatform->create();
    return $isCreated ;
}

function updatePlatform ($idPlatform, $namePlatform){
    $model = new Platform($idPlatform, $namePlatform);
    $isEdited = $model->update();
    return $isEdited ;
}

function getPlatformData($idPlatform){
    $platform = new Platform($idPlatform,null);
    $platformObject = $platform->getItem();
    return $platformObject; 
}

function deletePlatform ($idPlatform){
    $platform = new Platform($idPlatform,null);
    $platformDeleted = $platform->delete();
    return $platformDeleted;
}

?>

