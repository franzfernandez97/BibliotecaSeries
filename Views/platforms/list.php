<?php

require_once "../../controllers/platformsController.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List a Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <!-- Nav Bar-->  
    <?php include '..\..\includes\navbar.php';?> 

    <div class="container text-center mt-5 content">
        <h1 class="display-3">Lista de Plataformas</h1>
    
        <!-- Link to create View -->
        <div class="row">
            <div class="col text-start">
                <a class="btn btn-primary px-5" href="create.php">Crear</a>
            </div> 
        </div>
            
            <!-- Table Platform Data -->
            <div class="row mt-4">
                <?php
                $plataformList = listPlatforms();
                if (is_array($plataformList) && count($plataformList) > 0) {
                ?>
                    <!-- IF data exists -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($plataformList as $platform) {?>
                            <tr>
                                <td><?php echo $platform->getId ()?> </td>
                                <td><?php echo $platform->getName () ?> </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a class= "btn btn-success" href="edit.php?id=<?php echo $platform->getId(); ?>">Editar</a>
                                        <form name="delete_form" action="delete.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="platformId" value="<?php echo $platform->getId()?>">
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