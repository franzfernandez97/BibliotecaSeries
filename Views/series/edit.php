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
    <title>Edit a Serie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Nav Bar-->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/navbar.php';?>

    <!-- Main Info-->
    <div class="container text-center mt-5 content">
        <h1 class="display-3">Editar Series </h1>
        <?php
            $idSerie = $_GET['id'];
            try{
                $serieObject = getSerieData((int)$idSerie);
            } catch (Exception $error){
                $serieObject = $error->getMessage();
            }
        ?>

        <!-- Capture Error -->
        <?php if(is_string($serieObject)): ?>
                <div class='alert alert-danger' role='alert'>
                <p><?= $serieObject ?></p>
                <?php die; ?>
                </div>
        <?php endif; ?>
        <!-- ############# -->

        <?php
            $sendData = false;
            $serieEdited = false;

            if (isset($_POST["editBtn"])){
                $sendData = true;
            }

            if (isset($sendData)){
                if (isset($_POST["serieTitle"]) && isset($_POST['platform']) && isset($_POST['synopsis'])){
                    try{
                    $serieEdited = updateSerie((int)$_POST["serieId"], $_POST["serieTitle"], (int)$_POST['platform'],$_POST['synopsis'] );
                    } catch (Exception $error){
                        $serieEdited = $error->getMessage();
                    }
                ?>

                <!-- Capture Error -->
                <?php if(is_string($serieEdited)): ?>
                        <div class='alert alert-danger' role='alert'>
                        <p><?= $serieEdited ?></p>
                        <?php die; ?>
                        </div>
                <?php endif; ?>
                <!-- ############# -->
                <?php
                }
            }

            if(!$sendData){

        ?>

        <!-- Link to create View -->
        <div class="row justify-content-center">
            <div class="col-md-6"> <!-- Adjust column width for better alignment -->
            <form  action="edit.php?id=<?php echo $serieObject->getId(); ?>" style="display:inline;" method="POST">
                    <!-- Input serie tittle -->
                    <div class="mb-3">
                        <label for="serieTitle" class="form-label"></label>
                        <input id="serieTitle" name="serieTitle" type="text" class="form-control" placeholder="Ingresa un titulo" value="<?php echo $serieObject->getTitle()?>" required>
                        <input type="hidden" name="serieId" value="<?php echo $serieObject->getId(); ?>">
                    </div>

                    <!-- Input synopsis -->
                    <div class="mb-3">
                        <label for="synopsis" class="form-label"></label>
                        <textarea id="synopsis" name="synopsis" class="form-control" placeholder="Introduce sinopsis de la serie" rows="4" required><?php echo $serieObject->getSynopsis(); ?></textarea>
                    </div>

                    <!-- Combo Box for Platform -->
                    <div class="mb-3">
                        <label for="platform" class="form-label"></label>
                        <select id="platform" name="platform" class="form-select" required>
                            <option value="" disabled selected>Seleccione una plataforma</option>
                            <?php
                            try {
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
                                if ($platform->getId() == $serieObject->getplatformid()){
                                    echo "<option value='".$platform->getId()."' selected>".$platform->getName()."</option>";
                                }else{
                                    echo "<option value='".$platform->getId()."'>".$platform->getName()."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Submit button inside the form -->
                    <input type="submit" value="Editar" class="btn btn-primary" name="editBtn">
                </form>
            </div>
        </div>
    </div>

    <?php // if the user inserted values
    } else {

        if ($serieEdited) {
    ?>
            <div class='alert alert-success' role='alert'>
            ¡Serie editada con éxito!  <a href='list.php'>Volver al listado de series.</a>
            </div>

    <?php
            } else {
    ?>
                <div class='alert alert-danger' role='alert'>
                    ¡La serie no se ha editado!  <a href='edit.php?id=<?php echo $_POST["serieId"]?>'>Refrescar.</a>
                </div>
    <?php
            }
        }
    ?>
     <!-- Footer-->
     <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/footer.php'?>
</body>
