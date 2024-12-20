<?php
  require_once("../Controllers/ActoresController.php");

  $actors = new ActoresController();
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
    <?php foreach ($actors->getAll() as $actor): ?>
      <li><?= $actor['firstname']; ?></li>
    <?php endforeach; ?>
  </div>
</body>
</html>
