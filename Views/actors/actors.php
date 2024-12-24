<?php
  require_once("../controllers/actorsController.php");
  require_once("../constants/style.php");

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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <h1 class="h1">Funciona</h1>
    <?php foreach ($actors->getById(39) as $actor): ?>
      <li class=<?=COLOR_PRIMARIO?>>
        <?= ($actor) ? $actor['firstname'] : $actor; ?>
      </li>
    <?php endforeach; ?>
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
<button onClick=<?php $actors->deleteActor(5);?> >ELIMINAR REGISTRO</button>
  </div>
</body>
</html>
