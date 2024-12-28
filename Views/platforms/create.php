<?php
//Import libraries
require_once "../../controllers/platformsController.php";

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
<div class="container text-center mt-5">
    <h1 class="display-3">
        <!-- Home Icon using Bootstrap Icons -->
        <i class="bi bi-house-door" href></i> Crear Plataforma
    </h1>

    <!-- Link to create View -->
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Adjust column width for better alignment -->
            <form  action="create.php" style="display:inline;" method="POST">
                <div class="mb-3">
                    <label for="platformName" class="form-label"></label>
                    <input id="platformName" name="platformName" type="text" class="form-control" placeholder="Introduce una plataforma" required>
                </div>

                <!-- Submit button inside the form -->
                <button type="submit" class="btn btn-primary px-5 w-100">Crear</button>
            </form>
        </div>
    </div>
</div>

<?php

    if (isset($_POST['platformName'])) {

        $platformName = $_POST['platformName'];

        // is a valid name?
        if (!empty($platformName)) {

            //Create the platform
            $platformCreated = createPlatform($platformName);

            // Show Success Message
            if ($platformCreated){
                echo "<div class='alert alert-success'>¡Plataforma '$platformName' creada con éxito!</div>";
            } else {
                echo "<div class='alert alert-danger'>Plataforma '$platformName' ya esxiste en la DB. Por favor ingrese otro nombre</div>";
            }
            
        } else {
            // Warning Message
            echo "<div class='alert alert-danger'>Por favor ingrese un nombre válido</div>";
        }
    }
?>
</body>
