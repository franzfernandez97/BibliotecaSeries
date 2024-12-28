<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/actorsController.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/constants/style.php';

  $actors = new ActorsController();
  $actorsArray = $actors->getAll();


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
  <div class="container" >
  <h1 class="h1">Lista de actores</h1>
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
        <th>
          Editar
        </th>
        <th>
          Borrar
        </th>
      </tr>
    </thead>
    <tbody>
      <?php  if (count($actorsArray) > 0): ?>
        <?php foreach ($actorsArray as $actor): ?>
          <tr>
            <td><?= htmlspecialchars($actor["id"]) ?></td>
            <td><?= htmlspecialchars($actor["firstname"]) ?></td>
            <td><?= htmlspecialchars($actor["lastname"]) ?></td>
            <td><?= htmlspecialchars($actor["birthdate"]) ?></td>
            <td><?= htmlspecialchars($actor["nationality"]) ?></td>
            <td>
              <a class="btn btn-success" href="editActor.php?id=<?= htmlspecialchars($actor["id"]) ?>">Editar</a>
            </td>
            <td>
              <form name="deleteActor" action="deleteActor.php" method="POST">
                <input type="hidden" name="actorId" value="<?= htmlspecialchars($actor["id"]) ?>">
                <button type="submit" class="btn btn-danger">Borrar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="6">No hay actores</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  </div>
</body>
</html>
