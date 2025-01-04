<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/platformsModel.php';

function validacionTexto($input) {
    return preg_match('/^(?!\s)[\p{L}]+(?:[\p{L}\s+-]+)*$/u', $input);
}
function listPlatforms(): array|string {
    //check no arguments were used
    if (func_num_args()> 0){
        throw new InvalidArgumentException( "Error función listPlatforms: no acepta parametros");
    }
    $model = new Platform();
    try{
    $plataformList = $model->getAll();
    }catch (Exception $error) {
        throw new Exception($error->getMessage());
    }
    return $plataformList;
}


function createPlatform (string $namePlatform){
    //check if pass different arguments than 1
    if (func_num_args() !== 1) {
        throw new InvalidArgumentException("Error funcion createPlatform: requiere exactamente 1 parametro.");
    }

    // the argument is string or has spaces?
    if (!is_string($namePlatform) || !validacionTexto($namePlatform))  {
        throw new InvalidArgumentException("Error funcion createPlatform: parametro namePlatform debe ser una cadena (string).");
    }
    $newPlatform = new Platform(null, $namePlatform);
    try{
        $isCreated = $newPlatform->create();
    }catch (Exception $error) {
        return $error->getMessage();
    }
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
    if (!is_string($namePlatform) || !validacionTexto($namePlatform)) {
        throw new InvalidArgumentException("Error funcion updatePlatform: parametro 'namePlatform' debe ser una cadena (string).");
    }
    
    $model = new Platform($idPlatform, $namePlatform);
    try{
        $isEdited = $model->update();
    }catch (Exception $error) {
        return $error->getMessage();
    }
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
    try{
        $platformObject = $platform->getItem();
    }catch (Exception $error) {
        return $error->getMessage();
    }
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
    try{
        $platformDeleted = $platform->delete();
    }catch (Exception $error) {
        return $error->getMessage();
    }
    return $platformDeleted;
}
?>

