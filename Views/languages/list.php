<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/languagesController.php';
  $languagesList = getAllLanguges();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <title>Lenguajes</title>
</head>
<body>
  <!-- Nav Bar-->
  <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>

  <div class="container text-center mt-5 content" >
    <h1 class="display-3">Lista de idiomas</h1>
    <div class="row">
        <div class="col text-end mt-4">
            <a class="btn btn-primary px-5" href="createLanguage.php">Crear</a>
        </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>
            Id
          </th>
          <th>
            Nombres
          </th>
          <th>
            Código ISO
          </th>
          <th>
            Acciones
          </th>
        </tr>
      </thead>
      <tbody>
        <?php  if (count($languagesList) > 0): ?>
          <?php foreach ($languagesList as $actor): ?>
            <tr>
              <td><?= $actor->getLanguageId() ?></td>
              <td><?= $actor->getLanguageName() ?></td>
              <td><?= $actor->getLanguageCode() ?></td>
              <td>
                <div class="d-flex justify-content-center gap-2" role="group" aria-label="Acciones">
                  <a class="btn btn-success" href="editLanguage.php?id=<?= $actor->getLanguageId() ?>">Editar</a>

                  <form name="delete_form" action="deleteLanguage.php" method="POST">
                    <input type="hidden" name="languajeId" value="<?= $actor->getLanguageId() ?>">
                    <button type="submit" class="btn btn-danger">Borrar</button>
                  </form>
                  <a class="btn btn-primary" href="languageInformation.php?id=<?= $actor->getLanguageId() ?>">Ver</a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php elseif(is_string($languagesList)): ?>
          <div class='alert alert-danger' role='alert'>
            <p><?= $languagesList ?></p>
        </div>
        <?php else: ?>
          <tr>
            <td colspan="6">No hay lenguajes</td>
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
