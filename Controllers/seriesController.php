<?php
require_once "../../models/seriesModel.php";
function validacionTextoSerie($input) {
    return preg_match('/^(?!\s)[\p{L}\p{N}\s\.\-\+]+$/u', $input);
}
function listSeries(): array|string{
    //check no arguments were used
    if (func_num_args()> 0){
        throw new InvalidArgumentException( "Error función listSeries: no acepta parametros");
    }
    $model = new Series();
    try{
        $seriesList = $model->getAll();
    }catch (Exception $error) {
        throw new Exception($error->getMessage());
    }
    return $seriesList;
}

function createSerie ($titleSerie,$idSerie,$synopsisSerie){
    //check if pass different arguments than 1
    if (func_num_args() !== 3) {
        throw new InvalidArgumentException("Error funcion createSerie: requiere exactamente 3 parametro.");
    }

    // the argument is not string?
    if (!is_string($titleSerie) || !validacionTextoSerie($titleSerie)) {
        throw new InvalidArgumentException("Error funcion createSerie: parametro titleSerie debe ser una cadena (string) valida.");
    }

    // the argument is not int?
    if (!is_int($idSerie)) {
        throw new InvalidArgumentException("Error funcion createSerie: parametro idSerie debe ser un int.");
    }

    // is $synopsisSerie a string?
    if (!is_string($synopsisSerie) || !validacionTextoSerie($synopsisSerie)) {
        throw new InvalidArgumentException("Error funcion updateSerie: parametro 'synopsisSerie' debe ser una cadena (string) valida sin caracteres especiales.");
    }

    $newSerie = new Series(null, $titleSerie,$idSerie,$synopsisSerie);
    try{
        $isCreated = $newSerie->create();
    }catch (Exception $error) {
        throw new Exception($error->getMessage());
    }
    return $isCreated ;
}

function updateSerie ($idSerie, $titleSerie, $idPlatform, $synopsisSerie){
    //check if pass different arguments than 1
    if (func_num_args() !== 4) {
        throw new InvalidArgumentException("Error funcion updateSerie: requiere exactamente 4 parametros.");
    }

    // is $idSerie an INT?
    if (!is_int($idSerie)) {
        throw new InvalidArgumentException("Error funcion updateSerie: parametro 'idPlatform' debe ser un número entero (int).");
    }

    // is $idPlatform an INT?
    if (!is_int($idPlatform)) {
        throw new InvalidArgumentException("Error funcion updateSerie: parametro 'idPlatform' debe ser un número entero (int).");
    }

    // is $titleSerie a string?
    if (!is_string($titleSerie) || !validacionTextoSerie($titleSerie)) {
        throw new InvalidArgumentException("Error funcion updateSerie: parametro 'namePlatform' debe ser una cadena (string) valida.");
    }

    // is $synopsisSerie a string?
    if (!is_string($synopsisSerie) || !validacionTextoSerie($synopsisSerie)) {
        throw new InvalidArgumentException("Error funcion updateSerie: parametro 'synopsisSerie' debe ser una cadena (string) valida sin caracteres especiales.");
    }

    $model = new Series($idSerie, $titleSerie, $idPlatform, $synopsisSerie);
    try{
        $isEdited = $model->update();
    }catch (Exception $error) {
        throw new Exception($error->getMessage());
    }
        return $isEdited ;
}

function getSerieData($idSerie){
    //check if pass different arguments than 1
    if (func_num_args() !== 1) {
        throw new InvalidArgumentException("Error funcion getPlatformData: requiere exactamente 1 parametro.");
    }

    // is $idSerie an INT?
    if (!is_int($idSerie)) {
        throw new InvalidArgumentException("Error funcion getPlatformData: parametro 'idPlatform' debe ser un número entero (int).");
    }
    $platform = new Series($idSerie,null, null, null);
    try{
        $platformObject = $platform->getItem();
    }catch (Exception $error) {
        throw new Exception($error->getMessage());
    }
    return $platformObject; 
}

function deleteSerie ($idSerie){
    //check if pass different arguments than 1
    if (func_num_args() !== 1) {
        throw new InvalidArgumentException("Error funcion deletePlatform: requiere exactamente 1 parametro.");
    }

    // is $idSerie an INT?
    if (!is_int($idSerie)) {
        throw new InvalidArgumentException("Error funcion deletePlatform: parametro 'idSerie' debe ser un número entero (int).");
    }
    $platform = new Series($idSerie,null,null,null);
    try{
        $platformDeleted = $platform->delete();
    }catch (Exception $error) {
        throw new Exception($error->getMessage());
    }
        return $platformDeleted;
}
?>