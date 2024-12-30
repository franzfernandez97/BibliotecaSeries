<?php
require_once '../../Models/directorsModel.php';

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

?>

