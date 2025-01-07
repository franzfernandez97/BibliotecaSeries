<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/seriesInformationController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/seriesController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/controllers/platformsController.php';

$serieId = (int)$_GET['id'];

try{
$serieInformation = getSerieData($serieId);
} catch (Exception $error){
    $serieInformation = $error->getMessage();
}
?>
<!-- Capture Error -->
<?php if(is_string($serieInformation)): ?>
        <div class='alert alert-danger' role='alert'>
        <p><?= $serieInformation ?></p>
        <?php die; ?>
        </div>
<?php endif; ?>
<!-- ############# -->

<?php
try{
$platformObjt = getPlatformData((int)$serieInformation->getPlatformId());
} catch (Exception $error){
    $platformObjt = $error->getMessage();
}
?>
<!-- Capture Error -->
<?php if(is_string($platformObjt)): ?>
        <div class='alert alert-danger' role='alert'>
        <p><?= $platformObjt ?></p>
        <?php die; ?>
        </div>
<?php endif; ?>
<!-- ############# -->

<?php
try{
$actorsList = listActorsBySerie($serieId);
} catch (Exception $error){
    $actorsList = $error->getMessage();
}
?>
<!-- Capture Error -->
<?php if(is_string($actorsList)): ?>
        <div class='alert alert-danger' role='alert'>
        <p><?= $actorsList ?></p>
        <?php die; ?>
        </div>
<?php endif; ?>
<!-- ############# -->


<?php
try{
$directorsList = listDirectorsBySerie($serieId);
} catch (Exception $error){
    $directorsList = $error->getMessage();
}
?>
<!-- Capture Error -->
<?php if(is_string($directorsList)): ?>
        <div class='alert alert-danger' role='alert'>
        <p><?= $directorsList ?></p>
        <?php die; ?>
        </div>
<?php endif; ?>
<!-- ############# -->


<?php
try{
$lenguageDict = listLanguagesBySerie($serieId);
} catch (Exception $error){
    $lenguageDict = $error->getMessage();
}
?>
<!-- Capture Error -->
<?php if(is_string($lenguageDict)): ?>
        <div class='alert alert-danger' role='alert'>
        <p><?= $lenguageDict ?></p>
        <?php die; ?>
        </div>
<?php endif; ?>
<!-- ############# -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<!-- Nav Bar-->
<?php include '../../includes/navbar.php'; ?>

<!-- Main content -->
    <div class="container text-center mt-5 content">
    <h1 class="display-3"><?php echo $serieInformation->getTitle() ?></h1>
    </br></br>

        <!-- Platform Info -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center fw-bold align-middle" rowspan="3" style="width: 20%;">Plataforma</th>  
                    <td><?php echo $platformObjt->getName()?></td>
                </tr>
            </thead>
        </table>

        </br>
        <!-- Synopsis -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center fw-bold align-middle" rowspan="3" style="width: 20%;">Sinopsis</th>  
                    <td><?php echo $serieInformation->getSynopsis()?></td>
                </tr>
            </thead>
        </table>

        </br>
        <!-- Actors Info -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center fw-bold align-middle" rowspan="3" style="width: 20%;">Actores</th>
                    <?php 
                    $i = 0;
                    foreach ($actorsList as $actors): 
                    if ($i ==0){
                    ?> 
                        <td><?= $actors->getFirstName().' '.$actors->getlastName() ?></td>
                </tr>
                        </thead>
                        <tbody>
                    <?php
                    } else{
                    ?>

                    <tr>
                        <td></td>
                        <td><?= $actors->getFirstName().' '.$actors->getlastName() ?></td>
                    </tr>
                <?php } 
                    $i = $i + 1;
                    endforeach; ?>
            </tbody>
        </table>

        </br>
        <!-- Directors Info -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center fw-bold align-middle" rowspan="3" style="width: 20%;">Directores</th>
                    <?php 
                    $i = 0;
                    foreach ($directorsList as $directors): 
                    if ($i ==0){
                    ?> 
                        <td><?= $directors->getFirstName().' '.$directors->getlastName() ?></td>
                </tr>
                        </thead>
                        <tbody>
                    <?php
                    } else{
                    ?>

                    <tr>
                        <td></td>
                        <td><?= $directors->getFirstName().' '.$directors->getlastName() ?></td>
                    </tr>
                <?php } 
                    $i = $i + 1;
                    endforeach; ?>
            </tbody>
        </table>

        </br>
        <!-- Language Info -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center fw-bold align-middle" rowspan="3" style="width: 20%;">Idiomas</th>
                    <?php 
                    $i = 0;
                    foreach ($lenguageDict as $languaje): 
                    if ($i ==0){
                    ?> 
                        <td><?= "(".$languaje["language"]->getLanguageCode().") ".$languaje["language"]->getLanguageName().' - '.$languaje["type"] ?></td>
                </tr>
                        </thead>
                        <tbody>
                    <?php
                    } else{
                    ?>

                    <tr>
                        <td></td>
                        <td><?= "(".$languaje["language"]->getLanguageCode().") ".$languaje["language"]->getLanguageName().' - '.$languaje["type"] ?></td>
                    </tr>
                <?php } 
                    $i = $i + 1;
                    endforeach; ?>
            </tbody>
        </table>
    </div>

<!-- Footer-->
<?php include $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/includes/footer.php';?>

</body>