<?php
  require_once("../../controllers/actorsController.php");
  require_once("../../constants/style.php");

  $actors = new ActorsController();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $birthDate = $_POST["birthdate"];
    $nationality = $_POST["nationality"];
    $data = [$name, $lastName, $birthDate, $nationality];
    $result = $actors->updateActor(5, $data);
    echo $result;
  }

?>
<form action="actors.php" method="post">
  <div class="form-group">
    <label for="names">Nombres</label>
    <input type="text" class="form-control" id="name" name="firstname" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="lastname">Apellidos</label>
    <input type="text" class="form-control" id="lastname"  name="lastname" placeholder="Apellidos">
  </div>
  <div class="form-group">
    <label for="birthdate">Fecha de nacimiento</label>
    <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Fecha de nacimiento">
  </div>
  <div class="form-group">
    <label for="nationality">Nacionalidad</label>
    <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nacionalidad">
  </div>
  <button type="submit" class="btn btn-primary">Crear</button>
</form>
