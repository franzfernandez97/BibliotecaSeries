<?php
  require_once "../../controllers/actorsController.php";
  require_once "../../constants/style.php";

  $actors = new ActorsController();
  $actorsArray = $actors->getAll();
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
  <title>Peliculas</title>
</head>
<body>
  <div class=<?php $TABLE; ?> >
  <table class="table">
    <thead>
      <tr>
        <th>
          ID
        </th>
        <th>
          NOMBRES
        </th>
        <th>
          APELLIDOS
        </th>
        <th>
          FECHA DE NACIMIENTO
        </th>
        <th>
          NACIONALIDAD
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($actorsArray as $actor): ?>
        <tr>
          <td><?= htmlspecialchars($actor["id"]) ?></td>
          <td><?= htmlspecialchars($actor["firstname"]) ?></td>
          <td><?= htmlspecialchars($actor["lastname"]) ?></td>
          <td><?= htmlspecialchars($actor["birthdate"]) ?></td>
          <td><?= htmlspecialchars($actor["nationality"]) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<button onClick=<?php $actors->deleteActor(5);?> >ELIMINAR REGISTRO</button>
  </div>
</body>
</html>
