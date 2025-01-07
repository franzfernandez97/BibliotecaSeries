<?php
//Import libraries

require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/seriesController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/platformsController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Serie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Nav Bar-->  
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/navbar.php';?> 
    
    <!-- Main Info-->  
    <div class="container text-center mt-5 content">
        <h1 class="display-3">Crear Serie </h1>
        
        <?php
        // initial state before execution
        $sendData = false;
        $serieCreated = false;

        // If the buttom -Create- was clic
        // then sendData is true
        if (isset($_POST["createBtn"])){
            $sendData = true;
        }

        // If sendData is true
        if (isset($sendData)){
            //Check if POST variable serieTitle was assigned to create a platform
            //If platform Name exists

            if (isset($_POST["serieTitle"]) && isset($_POST['platform']) && isset($_POST['synopsis'])){
                $serieTitle = $_POST["serieTitle"];
                $serieSynopsis = $_POST['synopsis'];

                try{
                $serieCreated = createSerie($serieTitle, (int)$_POST['platform'], $serieSynopsis);
                } catch (Exception $error){
                    $serieCreated = $error->getMessage();
                }
            ?>    
                <!-- Capture Error -->
                <?php if(is_string($serieCreated)): ?>
                        <div class='alert alert-danger' role='alert'>
                        <p><?= $serieCreated ?></p>
                        <?php die; ?>
                        </div>
                <?php endif; ?>
                <!-- ############# -->
            <?php
    
                }  
        }

        //If is the first time a user enter then $sendData is False
        // a new user will se the form
        if (!$sendData){

        ?>
        
        <!-- Link to create View -->
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- Adjust column width for better alignment -->
                <form  action="create.php" style="display:inline;" method="POST">
                    <!-- Input serie tittle -->
                    <div class="mb-3">
                        <label for="serieTitle" class="form-label"></label>
                        <input id="serieTitle" name="serieTitle" type="text" class="form-control" placeholder="Introduce titulo de la serie" value="" required>
                    </div>

                    <!-- Input synopsis -->
                    <div class="mb-3">
                        <label for="synopsis" class="form-label"></label>
                        <textarea id="synopsis" name="synopsis" class="form-control" placeholder="Introduce sinopsis de la serie" rows="4" required></textarea>
                    </div>

                    <!-- Combo Box for Platform -->
                    <div class="mb-3">
                        <label for="platform" class="form-label"></label>
                        <select id="platform" name="platform" class="form-select" required>
                            <option value="" disabled selected>Seleccione una plataforma</option>
                            <?php
                            try{
                            $plataformList = listPlatforms();
                            } catch (Exception $error){
                                $plataformList = $error->getMessage();
                            }
                        ?>    
                            <!-- Capture Error -->
                            <?php if(is_string($plataformList)): ?>
                                    <div class='alert alert-danger' role='alert'>
                                    <p><?= $plataformList ?></p>
                                    <?php die; ?>
                                    </div>
                            <?php endif; ?>
                            <!-- ############# -->
                        <?php
                            foreach ($plataformList as $platform) {
                            echo "<option value='".$platform->getId()."'>".$platform->getName()."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Submit button inside the form -->
                    <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                </form>
            </div>
        </div>
    </div>

    <?php
    //If the user clicked the Create buttom is going to see a message
    //and this message can be positive or negative

        }else{
            //if the createPlatform was succesfully executed
            if ($serieCreated){
    ?>
            <div class='alert alert-success' role='alert'>
                ¡Serie creada con éxito en la plataforma! <a href='list.php'>Volver al listado de series.</a>
            </div>;
    <?php            
            } else {
    ?>                        
                <div class='alert alert-danger' role='alert'>
                    ¡Serie no ha sido creada ! ya existe en la DB. Por favor ingrese otro nombre <a href='create.php'>Refrescar.</a>
                </div>
    <?php
            }
        }
    ?>

     <!-- Footer-->  
     <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/footer.php'?> 
</body>
