<?php
require_once '../controllers/platformsController.php';
require_once '../constants/style.php';

//crea ojeto plataforma
$plataformas = new PlataformaController();

?>

<!DOCTYPE html>
<html lang="esp">

<head>
    <meta charset="UTF-8">
    <title>Platforms</title>


    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: <?php echo TABLA_BORDE; ?>;
            padding: 8px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: <?php echo TABLA_COLOR_FILA_ALTERNADA; ?>;
        }
        tr:nth-child(odd) {
            background-color: <?php echo TABLA_COLOR_FONDO; ?>;
        }
        td, th {
            color: <?php echo TABLA_TEXTO_FILA; ?>;
        }
    </style>
</head>

<body>

<!--READ ALL-->
    <h2>READ all</h2>
    <?php
    $platforms = $plataformas->getAll();
    ?>
    <table>
    <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($platforms as $platform): ?>
        
            <tr>
                <td><?php echo $platform['id']; ?></td>
                <td><?php echo $platform['name']; ?></td>
            </tr>
        </tbody>
    <?php endforeach; ?>
    </table>
<!--READ BY ID-->
<br/>

<h2>READ BY ID</h2>
    <?php
    $plataforma_id = $plataformas->getById(1);
    ?>
     <!-- Tabla -->
    <table>
    <thead>
        <tr>    
            <th>ID</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $plataforma_id['id']; ?></td>
            <td><?php echo $plataforma_id['name']; ?></td>
        </tr>
    </tbody>
    </table>

<!--ACTUALIZAR-->
<br/>

<h2>ANTES DE LA ACTUAZIACION BY ID</h2>
    <?php
    $plataforma_id = $plataformas->getById(5);
    ?>
     <!-- Tabla -->
    <table>
    <thead>
        <tr>    
            <th>ID</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $plataforma_id['id']; ?></td>
            <td><?php echo $plataforma_id['name']; ?></td>
        </tr>
    </tbody>
    </table>
    <h2>DESPUES DE LA ACTUAZIACION BY ID</h2>
    <?php
    $plataformas->update(5,"MR MAX");
    $plataforma_actualizada = $plataformas->getById(5);
    ?>
     <!-- Tabla -->
    <table>
    <thead>
        <tr>    
            <th>ID</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $plataforma_actualizada['id']; ?></td>
            <td><?php echo $plataforma_actualizada['name']; ?></td>
        </tr>
    </tbody>
    </table>

<!--CREAR-->
<br/>

<h2>CREAR Nueva Plataforma</h2>
    <?php
    $plataformas->create("Ejemplo ELIMINAR");

    ?>
     <h2>READ all</h2>
    <?php
    $platforms = $plataformas->getAll();
    ?>
    <table>
    <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($platforms as $platform): ?>
        
            <tr>
                <td><?php echo $platform['id']; ?></td>
                <td><?php echo $platform['name']; ?></td>
            </tr>
        </tbody>
    <?php endforeach; ?>
    </table>

<!--ELIMINAR-->
<br/>

<h2>CELIMINAR Plataforma</h2>
    <?php
    $plataformas->delete(29);

    ?>
     <!-- Tabla -->
     ?>
    <h2>READ all</h2>
    <?php
    $platforms = $plataformas->getAll();
    ?>
    <table>
    <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($platforms as $platform): ?>
        
            <tr>
                <td><?php echo $platform['id']; ?></td>
                <td><?php echo $platform['name']; ?></td>
            </tr>
        </tbody>
    <?php endforeach; ?>
    </table>

</body>