<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/seriesController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/platformsController.php';


try{
$seriesList = listSeries();
} catch (Exception $error){
    $seriesList = $error->getMessage();
}

//check if you must filter series List
if (isset($_GET["id"])){
    foreach ($seriesList as $key => $series) {
        if ((int)$series->getPlatformId() !== (int)$_GET["id"]) {
            unset($seriesList[$key]); // Remove the series object if the condition is met
        }
    }
    $seriesList = array_values($seriesList);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Series</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <!-- Nav Bar-->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/navbar.php';?>

    <div class="container text-center mt-5 content">
        <h1 class="display-3">Lista de Series</h1>

        <!-- Link to create View -->
        <div class="row">
            <div class="col text-start">
                <a class="btn btn-primary px-5" href="create.php">Crear</a>
            </div>
        </div>

        <!-- Capture Error -->
        <?php if(is_string($seriesList)): ?>
            <div class='alert alert-danger' role='alert'>
                <p><?= $seriesList ?></p>
                <?php die; ?>
            </div>
        <?php endif; ?>
        <!-- ############# -->

            <!-- Table series Data -->
            <div class="row mt-4">
                <?php

                if (is_array($seriesList) && count($seriesList) > 0) {
                ?>
                    <!-- IF data exists -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Plataforma</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($seriesList as $series) {?>
                            <tr>
                                
                                <td><?php echo $series->getId ()?> </td>
                                <td><?php echo $series->getTitle () ?> </td>
                                <td><?php
                                    try{
                                    $platformObjt = getPlatformData((int)$series->getPlatformId());
                                } catch (Exception $error){
                                    $platformObjt = $error->getMessage();
                                }?>
                                <!-- Capture Error -->
                                <?php if(is_string($platformObjt)): ?>
                                    <div class='alert alert-danger' role='alert'>
                                        <p><?= $platformObjt ?></p>
                                        <?php die; ?>
                                    </div>
                                <?php endif; ?>
                                <!-- ############# -->
                                <?php echo $platformObjt->getName() ?> </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2" role="group" aria-label="Acciones">
                                        <a class= "btn btn-success" href="edit.php?id=<?php echo $series->getId(); ?>">Editar</a>
                                        <form name="delete_form" action="delete.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="seriesId" value="<?php echo $series->getId()?>">
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                        </form>
                                        <a class="btn btn-primary" href="serieInformation.php?id=<?=$series->getId() ?>">Ver</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                <?php } else { ?>
                    <!-- IF doesn't exists -->
                    <div class="alert alert-danger" role="alert">
                    No data found.
                    </div>
                <?php } ?>
            </div>
    </div>

    <!-- Footer-->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/footer.php';?>

    <!-- Import the confirmDelete.js file -->
    <script src="/BibliotecaSeries/includes/confirmDelete.js"></script>
    <script>
        // Attach the confirmDelete function to the form's submit event
        document.forms["delete_form"].addEventListener("submit", confirmDelete);
    </script>

</body>
