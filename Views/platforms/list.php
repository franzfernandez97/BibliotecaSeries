<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/platformsController.php';
try{
    $plataformList = listPlatforms();
  } catch (Exception $error){
    $plataformList = $error->getMessage();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List a Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> -->


</head>
<body>
    <!-- Nav Bar-->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/navbar.php';?>

    <div class="container text-center mt-5 content">
        <h1 class="display-3">Lista de Plataformas</h1>

        <!-- Link to create View -->
        <div class="row">
            <div class="col text-start mb-3">
                <a class="btn btn-primary px-5" href="create.php">Crear</a>
            </div>
        </div>

      <!-- Capture Error -->
      <?php if(is_string($plataformList)): ?>
            <div class='alert alert-danger' role='alert'>
              <p><?= $plataformList ?></p>
              <?php die(); ?>
            </div>
            <?php endif; ?>
            <!-- ############# -->

      <?php if (is_array($plataformList) && count($plataformList) > 0) {
                ?>
                    <!-- IF data exists -->
                    <table class="table table-hover">
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
                                <div class="d-flex justify-content-center gap-2" role="group" aria-label="Acciones">
                                    <a class= "btn btn-success" href="edit.php?id=<?php echo $platform->getId(); ?>">Editar</a>
                                    <form name="delete_form" action="delete.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="platformId" value="<?php echo $platform->getId()?>">
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                    </form>
                                    <a class="btn btn-primary" href="/BibliotecaSeries/views/series/list.php?id=<?=$platform->getId() ?>">Ver</a>
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

    <!-- Footer-->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/footer.php';?>

    <!-- Import the confirmDelete.js file -->
    <script src="/BibliotecaSeries/includes/confirmDelete.js"></script>
    <script>
        // Attach the confirmDelete function to the form's submit event
        document.forms["delete_form"].addEventListener("submit", confirmDelete);
    </script>

</body>
