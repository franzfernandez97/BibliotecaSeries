<?php
  require_once $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/Controllers/languagesController.php';
  require_once $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/Controllers/languageSeriesController.php';
  require_once $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/Controllers/seriesController.php';

  $languageId = (int)$_GET['id'];
  $language = getLanguage(languageId: $languageId);
  $series = listSeries();
  $languageSeries = getSeriesByLanguage(languageId: $languageId);
  $seriesSelected = [];
  $languageType =[];
  $languageTypeArray = [
    'audio'=>'Audio',
    'subtitle'=>'Subtitulos'
  ];
  foreach ($languageSeries as $serieArray) {
    $serie = $serieArray['serie'];
    $type = $serieArray['languageType'];
    array_push($seriesSelected, $serie->getId());
    array_push($languageType, $type->getLanguageType());
  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar lenguaje</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
      <!-- Nav Bar-->
      <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/navbar.php';?>

    <!-- Main Info-->
    <div class="container text-center mt-5 content">
        <h1 class="display-4">Editar idioma </h1>

        <?php
        // initial state before execution
        $sendData = false;
        $actorCreated = false;

        // If the buttom -Create- was clic
        // then sendData is true
        if (isset($_POST["editButton"])){
            $sendData = true;
        }

        // If sendData is true
        if (isset($sendData)){
            //Check if POST variable platformName was assigned to create a platform
          if (isset($_POST["languageName"]) && isset($_POST["languageCode"])){
            $languageEdited = editLanguage(languageId: $languageId,languageName: $_POST['languageName'], languageCode: $_POST['languageCode']);
          }

          if (isset($_POST['series']) && isset($_POST['languagesType'])){
            updateRelationship($languageId, $_POST['series'], $_POST['languagesType']);
          }

        }

        //If is the first time a user enter then $sendData is False
        // a new user will se the form
        if (!$sendData){

        ?>

        <!-- Link to create View -->
        <div class="row justify-content-center w-100">
            <div class="w-50 align-items-center mb-10"> <!-- Adjust column width for better alignment -->
                <form  action="editLanguage.php?id=<?= $languageId ?>" class="d-flex flex-column mb-10" method="POST">
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="languageName" class="form-label">Idioma</label>
                        <input id="languageName" name="languageName" type="text" class="form-control" placeholder="Ingrese un idioma" value="<?= $language->getLanguageName() ?>" required>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                        <label for="languageCode" class="form-label">Código ISO</label>
                        <input id="languageCode" name="languageCode" type="text" class="form-control" placeholder="Ingrese un código" value="<?= $language->getLanguageCode() ?>" required>
                    </div>
                    <h2>Series asociadas</h2>
                    <div class="mb-3 d-flex flex-column align-items-start">
                      <label for="series" class="form-label">Series</label>
                      <select id="series" name="series[]" class="w-100 checkbox-list" multiple aria-label="multiple select example">
                        <option value="<?=(int)0?>"> --Seleccione una opción-- </option>
                        <?php foreach ($series as $serie): ?>
                            <?php if(in_array($serie->getId(), $seriesSelected)): ?>
                            <option value="<?= (int)$serie->getId() ?>"selected>
                              <?= $serie->getTitle() ?>
                            </option>
                            <?php else: ?>
                              <option value="<?= (int)$serie->getId() ?>">
                                <?= $serie->getTitle() ?>
                              </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3 d-flex flex-column align-items-start">
                      <label for="languagesType" class="form-label">Disponibilidad</label>
                      <select id="languages Type" name="languagesType[]" class="w-100 checkbox-list" multiple aria-label="multiple select example">
                        <option value=""> --Seleccione una opción-- </option>
                        <?php foreach ($languageTypeArray as $key => $value): ?>
                          <?php if(in_array($key, $languageType)): ?>
                              <option value="<?= $key ?>" selected>
                                <?= $value ?>
                              </option>
                              <?php else: ?>
                                <option value="<?= $key ?>">
                                  <?= $value ?>
                                </option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <!-- Submit button inside the form -->
                    <input type="submit" value="Editar" class="btn btn-primary" name="editButton">
                </form>
            </div>
        </div>
        <!-- Footer-->
      <?php include $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/includes/footer.php';?>
    </div>

    <?php
    //If the user clicked the Create buttom is going to see a message
    //and this message can be positive or negative

        }else{
            //if the createlanguage was succesfully executed
            if (is_string($languageEdited)) {
    ?>
            <div class='alert alert-danger' role='alert'>
                  <p><?= $languageEdited ?></p><a href='createLanguage.php'> Volver a intentar.</a>
              </div>
    <?php
            } else{
                // ElseWarning Message
    ?>
              <div class='alert alert-success' role='alert'>
                ¡El idioma fue creado con éxito! <a href='list.php'>Volver al listado de idiomas.</a>
              </div>
    <?php
          }
        }
    ?>
</body>
</html>
