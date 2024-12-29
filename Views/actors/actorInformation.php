<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/actorSeriesController.php';
$seriesList = listSeriesByActor(4);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <title>Peliculas</title>
</head>
<body>
  <ul>
    <?php foreach ($seriesList as $serie): ?>
      <li><?= $serie->getFirstName() ?></li>
    <?php endforeach; ?>
  </ul>
</body>
