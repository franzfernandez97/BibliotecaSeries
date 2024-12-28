<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/actorsController.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/constants/style.php';

  $actors = new ActorsController();
  $actorId = (int)$_GET['id'];
  $actor = $actors->getById($actorId);
  $sendData = false;
  $actorEdit = false;
  if (isset($_POST['editButton'])) {
    $sendData = true;
  }
  if ($sendData){
    $name = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $birthDate = $_POST["birthdate"];
    $nationality = $_POST["nationality"];
    $data = [$name, $lastName, $birthDate, $nationality];
    $result = $actors->updateActor($actorId, $data);
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Peliculas</title>
</head>
<body>
  <div class="container">
    <h1>Editar usuario</h1>
    <form action="" method="post">
      <div class="form-group">
        <label for="names">Nombres</label>
        <input type="text" class="form-control" id="name" name="firstname" value="<?= htmlspecialchars($actor[0]["firstname"] ?? '') ?>" placeholder="Nombre">
      </div>
      <div class="form-group">
        <label for="lastname">Apellidos</label>
        <input type="text" class="form-control" id="lastname"  name="lastname" value="<?= htmlspecialchars($actor[0]["lastname"] ?? '') ?>" placeholder="Apellidos">
      </div>
      <div class="form-group">
        <label for="birthdate">Fecha de nacimiento</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= htmlspecialchars($actor[0]["birthdate"] ?? '') ?>" placeholder="Fecha de nacimiento">
      </div>
      <div class="form-group">
        <label for="nationality">Nacionalidad</label>
        <input type="text" class="form-control" id="nationality" value="<?= htmlspecialchars($actor[0]["nationality"] ?? '') ?>" name="nationality" placeholder="Nacionalidad">
      </div>
      <button type="submit" class="btn btn-primary" name="editButton">Crear</button>
    </form>
  </div>
</body>
