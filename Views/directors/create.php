<?php
//Import libraries
require_once "../../controllers/directorsController.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear un Director</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Nav Bar-->  
    <?php include '..\..\includes\navbar.php';?> 

    <!-- Main Info-->
    <div class="container text-center mt-5 content">
        <h1 class="display-4">Crear Director </h1>

        <?php
        // initial state before execution
        $sendData = false;
        $directorCreated = false;

        // If the buttom -Create- was clic
        // then sendData is true
        if (isset($_POST["createBtn"])){
            $sendData = true;
        }

        // If sendData is true
        if (isset($sendData)){
            //Check if POST variable platformName was assigned to create a platform
            if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["birthDate"]) && isset($_POST["nationality"])){
                $directorCreated = createDirector(firstName: $_POST["firstName"], lastName: $_POST["lastName"], birthDate: $_POST["birthDate"], nationality: $_POST["nationality"]);
            }
        }

        //If is the first time a user enter then $sendData is False
        // a new user will se the form
        if (!$sendData){

        ?>

        <!-- Link to create View -->
        <div class="row justify-content-center w-100">
            <div class="w-50 align-items-center mb-10"> <!-- Adjust column width for better alignment -->
                <form  action="create.php" class="d-flex flex-column mb-10" method="POST">
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="firstName" class="form-label">Nombre</label>
                        <input id="firstName" name="firstName" type="text" class="form-control" placeholder="Introduce un nombre" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="lastName" class="form-label">Apellido</label>
                        <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Introduce una apellido" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="birthDate" class="form-label">Fecha de nacimiento</label>
                        <input id="birthDate" name="birthDate" type="date" class="form-control" value="" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="nationality" class="form-label">Nacionalidad</label>
                        <select name="nationality" id="nationality" class="form-control" >
                        <option value="">Seleccione una opcion</option>
                        <option value="USA">USA</option>
                        <option value="UK">UK</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Canada">Canada</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Spain">Spain</option>
                    </div>
                    <br><br>
                    <!-- Submit button inside the form -->
                    <input type="submit" value="Crear" class="btn btn-primary" name="createBtn">
                </form>
            </div>
        </div>
        <!-- Footer-->
        <?php include '..\..\includes\footer.php';?> 
    </div>

    <?php
    //If the user clicked the Create buttom is going to see a message
    //and this message can be positive or negative

        }else{
            //if the createPlatform was succesfully executed
            if ($directorCreated){
    ?>
            <div class='alert alert-success' role='alert'>
                ¡El director fue creado con éxito! <a href='list.php'>Volver al listado de directores.</a>
            </div>
    <?php
            } else {
                // ElseWarning Message
    ?>
                <div class='alert alert-danger' role='alert'>
                    ¡Director no ha sido creado ! ya existe en la DB. Por favor ingrese otro nombre <a href='create.php'>Refrescar.</a>
                </div>
    <?php
            }
        }
    ?>
</body>
</html>
