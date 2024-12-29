<?php
require_once "../../models/seriesModel.php";

function listSeries(){
    //check no arguments were used
    if (func_num_args()> 0){
        throw new InvalidArgumentException( "Error función listSeries: no acepta parametros");
    }
    $model = new Series(null, null, null);
    $seriesList = $model->getAll();
    return $seriesList;
}

function createSerie ($titleSerie,$idSerie){
    //check if pass different arguments than 1
    if (func_num_args() !== 2) {
        throw new InvalidArgumentException("Error funcion createSerie: requiere exactamente 1 parametro.");
    }

    // the argument is not string?
    if (!is_string($titleSerie)) {
        throw new InvalidArgumentException("Error funcion createSerie: parametro titleSerie debe ser una cadena (string).");
    }

    // the argument is not int?
    if (!is_int($idSerie)) {
        throw new InvalidArgumentException("Error funcion createSerie: parametro idSerie debe ser un int.");
    }

    $newSerie = new Series(null, $titleSerie,$idSerie);
    $isCreated = $newSerie->create();
    return $isCreated ;
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
    $platform = new Series($idSerie,null,null);
    $platformDeleted = $platform->delete();
    return $platformDeleted;
}
?>