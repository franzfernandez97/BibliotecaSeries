<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/actorsController.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/seriesController.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/actorSeriesController.php';

  $series = listSeries();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
      <!-- Nav Bar-->
      <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>

    <!-- Main Info-->
    <div class="container text-center mt-5 content">
        <h1 class="display-4">Crear Actor </h1>

        <?php
        // initial state before execution
        $sendData = false;
        $actorCreated = false;

        // If the buttom -Create- was clic
        // then sendData is true
        if (isset($_POST["createBtn"])){
            $sendData = true;
        }

        // If sendData is true
        if (isset($sendData)){
            //Check if POST variable platformName was assigned to create a platform
            if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["birthDate"]) && isset($_POST["nationality"])){
                $platformCreated = createActor(firstName: $_POST["firstName"], lastName: $_POST["lastName"], birthDate: $_POST["birthDate"], nationality: $_POST["nationality"]);
            }


            if (!empty($_POST['series']) && is_array($_POST['series']) && is_int($platformCreated)) {
              $seriesSelected = $_POST['series']; // Aquí tienes todas las
              $seriesId = [];
              // Ejemplo: Mostrar los valores seleccionados
              foreach ($seriesSelected as $serieId) {
                array_push($seriesId, $serieId);
              }
              addActorToSeries($platformCreated, $seriesId);
          }
        }

        //If is the first time a user enter then $sendData is False
        // a new user will se the form
        if (!$sendData){

        ?>

        <!-- Link to create View -->
        <div class="row justify-content-center w-100">
            <div class="w-50 align-items-center mb-10"> <!-- Adjust column width for better alignment -->
                <form  action="createActors.php" class="d-flex flex-column mb-10" method="POST">
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="firstName" class="form-label">Nombres</label>
                        <input id="firstName" name="firstName" type="text" class="form-control" placeholder="Ingrese un nombre" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="lastName" class="form-label">Apellidos</label>
                        <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Ingrese un apellido" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="birthDate" class="form-label">Fecha de nacimiento</label>
                        <input id="birthDate" name="birthDate" type="date" class="form-control" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="nationality" class="form-label">Nacionalidad</label>
                        <input id="nationality" name="nationality" type="text" class="form-control" placeholder="Ingrese una nacionalidad" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="series" class="form-label">Series en que trabajó</label>
                        <select id="series" name="series[]" class="w-100 checkbox-list" multiple aria-label="multiple select example">
                          <option value="<?=(int)0?>" selected> --Seleccione una opción-- </option>
                          <?php foreach ($series as $serie): ?>
                              <option value="<?= (int)$serie->getId() ?>">
                                <?= $serie->getTitle() ?>
                              </option>
                          <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Submit button inside the form -->
                    <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
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
            if ($platformCreated && is_string($platformCreated)){
    ?>
            <div class='alert alert-danger' role='alert'>
                <?= $platformCreated ?> <a href='createActors.php'>Refrescar.</a>
            </div>
    <?php
            } else {
                // ElseWarning Message
    ?>
              <div class='alert alert-success' role='alert'>
                ¡El actor fue creado con éxito! <a href='list.php'>Volver al listado de actores.</a>
              </div>;
    <?php
            }
        }
    ?>
</body>
</html>
