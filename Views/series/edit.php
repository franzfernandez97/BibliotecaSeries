<?php
//Import libraries
require_once "../../controllers/seriesController.php";
require_once "../../controllers/platformsController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a Serie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Nav Bar-->  
    <?php include '..\..\includes\navbar.php';?> 
    
    <!-- Main Info-->  
    <div class="container text-center mt-5 content">
        <h1 class="display-3">Editar Series </h1>
        <?php 
            $idSerie = $_GET['id'];
            $serieObject = getSerieData((int)$idSerie);
            $nameActualPlatform = getPlatformData((int)$idSerie);
            
            $sendData = false;
            $serieEdited = false;

            if (isset($_POST["editBtn"])){
                $sendData = true;
            }

            if (isset($sendData)){
                if (isset($_POST["serieTitle"]) && isset($_POST['platform'])){
                    $serieTitle = $_POST["serieTitle"];
                    $platformSelected = getPlatformIdByName($_POST['platform']);
                    $serieEdited = updateSerie((int)$idSerie, (int)$serieTitle, (int)$platformSelected);
                }  
            }

            if(!$sendData){

        ?>

        <!-- Link to create View -->
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- Adjust column width for better alignment -->
            <form  action="create.php" style="display:inline;" method="POST">
                    <!-- Input serie tittle -->
                    <div class="mb-3">
                        <label for="serieTitle" class="form-label"></label>
                        <input id="serieTitle" name="serieTitle" type="text" class="form-control" placeholder="<?php echo $serieObject->getTitle()?>" value="" required>
                    </div>

                    <!-- Combo Box for Platform -->
                    <div class="mb-3">
                        <label for="platform" class="form-label"></label>
                        <select id="platform" name="platform" class="form-select" required>
                            <option value="" disabled selected>Seleccione una plataforma</option>
                            <?php 
                            $plataformList = listPlatforms();
                            foreach ($plataformList as $platform) {
                                if ($platform->getName() == $nameActualPlatform->getName()){
                                    echo "<option value='".$platform->getName()."' selected>".$platform->getName()."</option>";
                                }else{
                                    echo "<option value='".$platform->getName()."'>".$platform->getName()."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Submit button inside the form -->
                    <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                </form>
            </div>
        </div>
        <a href=""></a>
    </div>
    
    <?php // if the user inserted values 
    } else {
        
        if ($serieEdited) {
    ?>  
            <div class='alert alert-success' role='alert'>
            ¡Plataforma editada con éxito!  <a href='list.php'>Volver al listado de plataformas.</a>
            </div>;

    <?php            
            } else {
                // Warning Message
    ?>                        
                <div class='alert alert-danger' role='alert'>
                    ¡Plataforma no se ha editado!  <a href='edit.php?id=<?php echo $idSerie?>'>Refrescar.</a>
                </div>
    <?php
            }
        }
    ?>
     <!-- Footer-->  
     <?php include '..\..\includes\footer.php';?> 
</body>
