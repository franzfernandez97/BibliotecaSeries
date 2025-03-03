<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/directorsController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar un Director</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Nav Bar-->
    <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>

    <!-- Main Info-->
    <div class="container text-center mt-5 content">
        <h1 class="display-3">Eliminar Director</h1>
    <?php

    //main variables
    $idDirector = $_POST['directorId'];
    $directorDeleted = deleteDirector((int)$idDirector);

    //Checkl the delete Result
    if($directorDeleted){
    ?>
        <div class='alert alert-success' role='alert'>
            Director borrado correctamente! <a href='list.php'>Volver al listado de directores.</a>
        </div>
    <?php
    } else {
            // Else Warning Message
    ?>
        <div class='alert alert-danger' role='alert'>
            Director no ha sido borrado! <a href='list.php'>Por favor vuelve a intentarlo.</a>
        </div>
    <?php
    }
    ?>
