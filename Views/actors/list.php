<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/actorsController.php';
  $actorList = listActors();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <title>Actores</title>
</head>
<body>
  <!-- Nav Bar-->
  <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>

  <div class="container text-center mt-5 content" >
    <h1 class="display-3">Lista de actores</h1>
    <div class="row">
        <div class="col text-start mb-3">
            <a class="btn btn-primary px-5" href="createActors.php">Crear</a>
        </div>
    </div>
    <?php if(is_string($actorList)): ?>
          <div class='alert alert-danger' role='alert'>
            <p><?= $actorList ?></p>
          </div>
          <?php die; ?>
    <?php endif; ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>
            Id
          </th>
          <th>
            Nombres
          </th>
          <th>
            Apellidos
          </th>
          <th>
            Fecha de nacimiento
          </th>
          <th>
            Nacionalidad
          </th>
          <th>
            Acciones
          </th>
        </tr>
      </thead>
      <tbody>
        <?php  if (count($actorList) > 0): ?>
          <?php foreach ($actorList as $actor): ?>
            <tr>
              <td><?= $actor->getActorId() ?></td>
              <td><?= $actor->getFirstName() ?></td>
              <td><?= $actor->getLastName() ?></td>
              <td><?= $actor->getBirthDate() ?></td>
              <td><?= $actor->getNationality() ?></td>
              <td>
                <div class="d-flex justify-content-center gap-2" role="group" aria-label="Acciones">
                  <a class="btn btn-success" href="editActor.php?id=<?= $actor->getActorId() ?>">Editar</a>

                  <form name="delete_form" action="deleteActor.php" method="POST">
                    <input type="hidden" name="actorId" value="<?= $actor->getActorId() ?>">
                    <button type="submit" class="btn btn-danger">Borrar</button>
                  </form>
                  <a class="btn btn-primary" href="actorInformation.php?id=<?= $actor->getActorId() ?>">Ver</a>
                </div>
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

  <!-- Footer-->
  <?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/footer.php';?>
  <script src='/BibliotecaSeries/includes/confirmDelete.js'></script>
  <script>
      // Attach the confirmDelete function to the form's submit event
      document.forms["delete_form"].addEventListener("submit", confirmDelete);
  </script>
</body>
</html>
