<?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/actorsController.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/constants/style.php';

  print_r((int)$_POST("actorId"));

  $idActor = (int)$_POST("actorId");

  $actor = new ActorsController();
  $resultDelete = $actor->deleteActor($idActor);

  if ($resultDelete) { ?>
    <div class="row">
      <div class="alert alert-success" role="alert">
        Se borro el usuario correctamente.
        <br>
        <a href="actors.php">Volver a la lista</a>
      </div>
    </div>
    <?php
  }else { ?>
    <div class="row">
      <div class="alert alert-danger" role="alert">
        No se pudo borrar el usuario.
        <br>
        <a href="actors.php">Volver a la lista</a>
      </div>
    </div>
    <?php
  }
  ?>

?>
