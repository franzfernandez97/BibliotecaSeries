<?php
//Import libraries
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/platformsController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete a Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Nav Bar-->  
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/navbar.php';?> 
    
    <!-- Main Info-->  
    <div class="container text-center mt-5 content">
        <h1 class="display-3">Eliminar Plataforma </h1>
    <?php

    //main variables
    $idPlatform = $_POST['platformId'];
    
    try{
        $platformDeleted = deletePlatform ((int)$idPlatform);
      } catch (Exception $error){
        $platformDeleted = $error->getMessage();
      }
?>    
      <!-- Capture Error -->
      <?php if(is_string($platformDeleted)): ?>
            <div class='alert alert-danger' role='alert'>
              <p><?= $platformDeleted ?></p>
              <?php die; ?>
            </div>
      <?php endif; ?>
      <!-- ############# -->
<?php
    //Checkl the delete Result
    if($platformDeleted){
    ?>
        <div class='alert alert-success' role='alert'>
            ¡Plataforma borrada correctamente! <a href='list.php'>Volver al listado de plataformas.</a>
        </div>
    <?php            
    } else {
            // Else Warning Message
    ?>                        
        <div class='alert alert-danger' role='alert'>
            ¡Plataforma no ha sido borrada! <a href='list.php'>Por favor vuelve a intentarlo.</a>
        </div>
    <?php
    }
    ?>
    <!-- Footer-->  
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/footer.php';?> 
</body>