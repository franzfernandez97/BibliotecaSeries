<?php
//Import libraries
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/platformsController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Nav Bar-->  
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/navbar.php';?> 
    
    <!-- Main Info-->  
    <div class="container text-center mt-5 content">
        <h1 class="display-3">Editar Plataforma </h1>
        <?php 
            $idPlatform = $_GET['id'];
            try{
                $platformObject = getPlatformData((int)$idPlatform);
              } catch (Exception $error){
                $platformObject = $error->getMessage();
              }
        ?>    
              <!-- Capture Error -->
              <?php if(is_string($platformObject)): ?>
                    <div class='alert alert-danger' role='alert'>
                      <p><?= $platformObject ?></p>
                      <?php die; ?>
                    </div>
              <?php endif; ?>
              <!-- ############# -->
        <?php
            $sendData = false;
            $platformEdited = false;

            if (isset($_POST["editBtn"])){
                $sendData = true;
            }

            if (isset($sendData)){
                if (isset($_POST["platformName"])){
                    $platformEdited = updatePlatform((int)$_POST["platformId"], $_POST["platformName"]);
                }  
            }

            if(!$sendData){
        ?>

        <!-- Link to create View -->
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- Adjust column width for better alignment -->
                <form  action="" style="display:inline;" method="POST">
                    <div class="mb-3">
                        <label for="platformName" class="form-label"></label>
                        <input id="platformName" name="platformName" type="text" class="form-control" placeholder="Introduce una plataforma" required value="<?php if(isset($platformObject)) echo $platformObject->getName()?>" >
                        <input type="hidden" name="platformId" value="<?php echo $idPlatform; ?>">
                        <input type="submit" value="Editar" class="btn btn-primary" name="editBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php // if the user inserted values 
    } else {
        
        if ($platformEdited) {
    ?>  
            <div class='alert alert-success' role='alert'>
            ¡Plataforma editada con éxito!  <a href='list.php'>Volver al listado de plataformas.</a>
            </div>;

    <?php            
            } else {
                // Warning Message
    ?>                        
                <div class='alert alert-danger' role='alert'>
                    ¡Plataforma no se ha editado!  <a href='edit.php?id=<?php echo $idPlatform?>'>Refrescar.</a>
                </div>
    <?php
            }
        }
    ?>
     <!-- Footer-->  
     <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/footer.php';?> 
</body>
