<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/directorSeriesController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/directorsController.php';

$directorId = (int)$_GET['id'];
$directorInformation = getDirector($directorId, true);$seriesList = listSeriesByDirector($directorId);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title><?= $directorInformation->getFirstName() ?></title>
  </head>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>
    <div class="container content">
      <div class="d-flex flex-column w-100 h-25 align-items-center">
        <h1 class="mb-5 mt-5">
          Información <?= $directorInformation->getFirstName().' '.$directorInformation->getLastName() ?>
        </h1>
        <section class="d-flex flex-column justify-content-start align-items-center w-100">
          <table class="table table-hover border-2 rounded-2 w-50">
            <tbody>
              <tr>
                <td><strong>Nombre: </strong></td>
                <td><?= $directorInformation->getFirstName() ?></td>
              </tr>
              <tr>
                <td><strong>Apellidos: </strong></td>
                <td><?= $directorInformation->getLastName() ?></td>
              </tr>
              <tr>
                <td><strong>Fecha de nacimiento: </strong></td>
                <td><?= $directorInformation->getBirthDate() ?></td>
              </tr>
              <tr>
                <td><strong>Nacionalidad: </strong></td>
                <td><?= $directorInformation->getNationality() ?></td>
              </tr>
            </tbody>
          </table>
        </section>
      </div>
      <section class="d-flex w-100 justify-content-center mb-10 mt-5">
        <table class="table table-hover border-2 w-50">
          <thead class="border rounded-top">
            <tr>
              <th>Series</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($seriesList as $serie): ?>
              <tr>
                <td><?= $serie->getTitle() ?></td>
              </tr>
              <?php endforeach; ?>
          </tbody>
        </table>

      </section>
      <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/footer.php';?>
    </div>
  </body>
</html>
