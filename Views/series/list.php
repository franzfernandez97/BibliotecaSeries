<?php
//Import libraries
require_once "../../controllers/seriesController.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List a Series</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <!-- Nav Bar-->  
    <?php include '..\..\includes\navbar.php';?> 

    <div class="container text-center mt-5 content">
        <h1 class="display-3">Lista de Series</h1>
    
        <!-- Link to create View -->
        <div class="row">
            <div class="col text-start">
                <a class="btn btn-primary px-5" href="create.php">Crear</a>
            </div> 
        </div>
            
            <!-- Table series Data -->
            <div class="row mt-4">
                <?php
                $seriesList = listSeries();
                if (is_array($seriesList) && count($seriesList) > 0) {
                ?>
                    <!-- IF data exists -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Id Plataforma</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($seriesList as $series) {?>
                            <tr>
                                <td><?php echo $series->getId ()?> </td>
                                <td><?php echo $series->getTitle () ?> </td>
                                <td><?php echo $series->getPlatformId() ?> </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a class= "btn btn-success" href="edit.php?id=<?php echo $series->getId(); ?>">Editar</a>
                                        <form name="delete_form" action="delete.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="seriesId" value="<?php echo $series->getId()?>">
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                        </form>
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
    <?php include '..\..\includes\footer.php';?> 

    <!-- Import the confirmDelete.js file -->
    <script src="..\..\includes\confirmDelete.js"></script>
    <script>
        // Attach the confirmDelete function to the form's submit event
        document.forms["delete_form"].addEventListener("submit", confirmDelete);
    </script>

</body>