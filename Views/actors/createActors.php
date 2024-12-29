<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/actorsController.php';


?>
<!DOCTYPE html>
<html lang="en">
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
      <?php include '../../includes/navbar.php';?>

    <!-- Main Info-->
    <div class="container text-center mt-5 content">
        <h1 class="display-3">Crear Actor </h1>

        <?php
        // initial state before execution
        $sendData = false;
        $platformCreated = false;

        // If the buttom -Create- was clic
        // then sendData is true
        if (isset($_POST["createBtn"])){
            $sendData = true;
        }

        // If sendData is true
        if (isset($sendData)){
            //Check if POST variable platformName was assigned to create a platform

            if (isset($_POST["platformName"])){
                $platformCreated = createPlatform($_POST["platformName"]);
            }
        }

        //If is the first time a user enter then $sendData is False
        // a new user will se the form
        if (!$sendData){

        ?>

        <!-- Link to create View -->
        <div class="row justify-content-center w-100">
            <div class="w-50 align-items-center"> <!-- Adjust column width for better alignment -->
                <form  action="create.php" class="d-flex flex-column" method="POST">
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="firstName" class="form-label">Nombres</label>
                        <input id="firstName" name="firstName" type="text" class="form-control" placeholder="Julian" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="lastName" class="form-label">Apellidos</label>
                        <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Introduce una plataforma" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="birthDate" class="form-label">Fecha de nacimiento</label>
                        <input id="birthDate" name="birthDate" type="date" class="form-control" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="nationality" class="form-label">Nacionalidad</label>
                        <input id="nationality" name="nationality" type="text" class="form-control" placeholder="Introduce una plataforma" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="series" class="form-label">Nacionalidad</label>
                        <select name="series" id="series" class="form-control" value="">
                          <?php foreach ($series as $serie): ?>
                            <option value="<?= $serie->getSerieId() ?>"><?= $serie->getSerieName() ?></option>
                        </select>
                    </div>

                    <!-- Submit button inside the form -->
                    <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                    <!--<button type="submit" class="btn btn-primary px-5 w-100">Crear</button>-->
                </form>
            </div>
        </div>
    </div>

    <?php
    //If the user clicked the Create buttom is going to see a message
    //and this message can be positive or negative

        }else{
            //if the createPlatform was succesfully executed
            if ($platformCreated){
    ?>
            <div class='alert alert-success' role='alert'>
                ¡Plataforma '<?php $_POST['platformName']?>' creada con éxito! <a href='list.php'>Volver al listado de plataformas.</a>
            </div>;
    <?php
            } else {
                // ElseWarning Message
    ?>
                <div class='alert alert-danger' role='alert'>
                    ¡Plataforma no ha sido creada ! ya esxiste en la DB. Por favor ingrese otro nombre <a href='create.php'>Refrescar.</a>
                </div>
    <?php
            }
        }
    ?>

     <!-- Footer-->
     <?php include '../../includes/footer.php';?>
</body>
