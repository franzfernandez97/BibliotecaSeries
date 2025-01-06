<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/directorsController.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/seriesController.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/directorSeriesController.php';

  $directorId = (int)$_GET['id'];
  $director = getDirector(directorId: $directorId);

  $seriesDirector = listSeriesByDirector(directorId: $directorId);
  $series = listSeries();
  $listSeries = [];
  foreach ($seriesDirector as $serie){
    array_push($listSeries, $serie->getId());
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar un Director</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
      <!-- Nav Bar-->
      <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>
    <!-- Main Info-->
    <div class="container text-center mt-5 content">
        <h1 class="display-4">Editar Director </h1>

        <?php
        // initial state before execution
        $sendData = false;
        $directorCreated = false;

        // If the buttom -Create- was clic
        // then sendData is true
        if (isset($_POST["editButton"])){
            $sendData = true;
        }

        // If sendData is true
        if (isset($sendData)){
            //Check if POST variable platformName was assigned to create a platform
            if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["birthDate"]) && isset($_POST["nationality"])){
                $directorCreated = updateDirector(directorId: $directorId,firstName: $_POST["firstName"], lastName: $_POST["lastName"], birthDate: $_POST["birthDate"], nationality: $_POST["nationality"]);
            }

            if (!empty($_POST['series']) && is_array($_POST['series'])) {
                $seriesSelected = $_POST['series']; // Aquí tienes todas las
                $seriesId = [];
                // Ejemplo: Mostrar los valores seleccionados
                foreach ($seriesSelected as $serieId) {
                  array_push($seriesId, $serieId);
                }
                updateDirectorSeries($directorId, $seriesId);
            }
        }

        //If is the first time a user enter then $sendData is False
        // a new user will se the form
        if (!$sendData){

        ?>

        <!-- Link to create View -->
        <div class="row justify-content-center w-100">
            <div class="w-50 align-items-center mb-10"> <!-- Adjust column width for better alignment -->
                <form  action="edit.php?id=<?= $director->getDirectorId() ?>" class="d-flex flex-column mb-10" method="POST">
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="firstName" class="form-label">Nombres</label>
                        <input id="firstName" name="firstName" type="text" class="form-control" placeholder="Ingrese un nombre" value="<?= $director->getFirstName() ?>" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="lastName" class="form-label">Apellidos</label>
                        <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Ingrese un apellido" value="<?= $director->getLastName() ?>" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="birthDate" class="form-label">Fecha de nacimiento</label>
                        <input id="birthDate" name="birthDate" type="date" class="form-control" value="<?= $director->getbirthDate() ?>" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="nationality" class="form-label">Nacionalidad</label>
                        <input id="nationality" name="nationality" type="text" class="form-control" placeholder="Ingrese la necionalidad" value="<?= $director->getNationality() ?>" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="series" class="form-label">Series que dirigió</label>
                        <select id="series" name="series[]" class="w-100 checkbox-list" multiple aria-label="multiple select example">
                          <option value="<?=(int)0?>" > --Seleccione una opción-- </option>
                          <?php foreach ($series as $serie):
                            if(in_array($serie->getId(), $listSeries)) {
                            ?>
                              <option value="<?= (int)$serie->getId() ?>" selected>
                                <?= $serie->getTitle() ?>
                              </option>
                            <?php } else { ?>
                              <option value="<?= (int)$serie->getId() ?>">
                                <?= $serie->getTitle() ?>
                              </option>
                          <?php }
                          endforeach; ?>
                        </select>
                    </div>

                    <!-- Submit button inside the form -->
                    <input type="submit" value="Editar" class="btn btn-primary" name="editButton">
                </form>
            </div>
        </div>
        <!-- Footer-->
      <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/footer.php';?>
    </div>

    <?php
    //If the user clicked the Create buttom is going to see a message
    //and this message can be positive or negative

        }else{

            //if the createPlatform was succesfully executed
            if ($directorCreated && is_string($directorCreated)){
                ?>
                        <div class='alert alert-danger' role='alert'>
                            <?= $directorCreated ?> <a href='edit.php'>Refrescar.</a>
                        </div>
                <?php
                        } else {
                            // ElseWarning Message
                ?>
                          <div class='alert alert-success' role='alert'>
                            ¡El director fue editado con éxito! <a href='list.php'>Volver al listado de directores.</a>
                          </div>;
                <?php
                        }
        }
    ?>
</body>
</html>
