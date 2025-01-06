<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/Controllers/languagesController.php';
  require_once $_SERVER['DOCUMENT_ROOT'] .'/BibliotecaSeries/Controllers/languageSeriesController.php';

  $languageId = $_GET['id'];
  $language = getLanguage(languageId: $languageId);
  $seriesAudio = getSeriesAudio(languageId: $languageId);
  $seriesSubtitle = getSeriesSubtitle(languageId: $languageId);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title><?= $language->getLanguageName(); ?></title>
</head>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>
  <div class="container content">
  <div class="d-flex flex-column w-100 h-25 align-items-center">
    <h1 class="mb-5 mt-5">
      Información Idioma
    </h1>
    <section class="d-flex flex-column justify-content-start align-items-center w-100 mb-5">
      <table class="table w-50 text-center">
        <thead>
          <tr>
            <th>Idioma</th>
            <th>Códiogo ISO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?= $language->getLanguageName() ?></td>
            <td><?= $language->getLanguageCode() ?></td>
          </tr>
        </tbody>
      </table>
    </section>
    <h2>Disponible para las series</h2>
    <div class="w-100 d-flex">
      <section class="d-flex flex-column justify-content-start w-50 mb-5">
      <table class="table">
          <thead>
            <tr>
              <th>Audio</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($seriesAudio as $serie): ?>
              <tr>
                <td><?= $serie->getTitle() ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
      <section class="d-flex flex-column justify-content-start w-50 mb-5">
      <table class="table">
          <thead>
            <tr>
              <th>Subtitulos</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($seriesSubtitle as $serie): ?>
              <tr>
                <td><?= $serie->getTitle() ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
    </div>
  </div>
  </div>
</body>
</html>
