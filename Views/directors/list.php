<?php

  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/directorsController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Directores</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <!-- Nav Bar-->
    <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>

    <div class="container text-center mt-5 content">
        <h1 class="display-3">Lista de Directores</h1>

        <!-- Link to create View -->
        <div class="row">
            <div class="col text-start">
                <a class="btn btn-primary px-5" href="create.php">Crear</a>
            </div>
        </div>

            <!-- Table Platform Data -->
            <div class="row mt-4">
                <?php
                $directorList = listDirectors();
                if (is_array($directorList) && count($directorList) > 0) {
                ?>
                    <!-- IF data exists -->
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha Nacimiento</th>
                                <th>Nacionalidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($directorList as $director) {?>
                            <tr>
                                <td><?php echo $director->getDirectorId()?> </td>
                                <td><?php echo $director->getFirstName()?> </td>
                                <td><?php echo $director->getLastName()?> </td>
                                <td><?php echo $director->getbirthDate()?> </td>
                                <td><?php echo $director->getNationality()?> </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2" role="group" aria-label="Acciones">
                                        <a class= "btn btn-success" href="edit.php?id=<?php echo $director->getDirectorId(); ?>">Editar</a>
                                        <form name="delete_form" action="delete.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="directorId" value="<?php echo $director->getDirectorId()?>">
                                            <button type="submit" class="btn btn-danger">Borrar</button>
                                        </form>
                                        <a class="btn btn-primary" href="directorInformation.php?id=<?= $director->getDirectorId() ?>">Ver</a>
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
    <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/footer.php';?>

    <!-- Import the confirmDelete.js file -->
    <script src="/BibliotecaSeries/includes/confirmDelete.js"></script>
    <script>
        // Attach the confirmDelete function to the form's submit event
        document.forms["delete_form"].addEventListener("submit", confirmDelete);
    </script>

</body>
