<?php
// Incluir el archivo de configuración
require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/controllers/platformsController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/constants/style.php';


//crea ojeto plataforma
$plataformas = new PlataformaController();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Plataforma</title>

    <style>
        /* Usamos las constantes definidas en config.php */
        body {
            font-family: <?php echo FUENTE_TEXTO; ?>;
            background-color: <?php echo COLOR_FONDO; ?>;
            color: <?php echo COLOR_TEXTO; ?>;
            padding: <?php echo ESPACIADO_PAGINA; ?>;
        }

        .container {
            max-width: <?php echo ANCHO_MAXIMO; ?>;
            margin: 0 auto;
            padding: <?php echo ESPACIADO_PAGINA; ?>;
        }

        h2 {
            font-family: <?php echo FUENTE_TITULOS; ?>;
            font-size: <?php echo TAMANIO_TITULO; ?>;
            text-align: center;
        }

        .form-group {
            margin-bottom: <?php echo ESPACIADO_CAMPOS; ?>;
        }

        label {
            font-size: <?php echo TAMANIO_TEXTO; ?>;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: <?php echo BORDE_ESTILO; ?>;
            border-radius: <?php echo BORDE_RADIUS; ?>;
            font-size: <?php echo TAMANIO_TEXTO; ?>;
            background-color: <?php echo CAMPO_BUSQUEDA_FONDO; ?>;
            color: <?php echo CAMPO_BUSQUEDA_COLOR; ?>;
        }

        button {
            padding: 0.75rem 1.25rem;
            font-size: <?php echo TAMANIO_TEXTO; ?>;
            background-color: <?php echo BOTON_FONDO; ?>;
            color: <?php echo BOTON_COLOR; ?>;
            border: none;
            border-radius: <?php echo BORDE_RADIUS; ?>;
            cursor: pointer;
            box-shadow: <?php echo SOMBRA_CUADRO; ?>;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: <?php echo BOTON_FONDO_SECUNDARIO; ?>;
        }

        .alert {
            padding: 1rem;
            border-radius: <?php echo BORDE_RADIUS; ?>;
            margin-top: 1rem;
        }

        .alert-success {
            background-color: <?php echo COLOR_EXITO; ?>;
            color: #fff;
        }

        .alert-danger {
            background-color: <?php echo COLOR_ERROR; ?>;
            color: #fff;
        }
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

<div class="container">
    <h2>Crear Plataforma</h2>

    <!-- Formulario para crear una plataforma -->
    <form action="createPlatforms.php" method="POST">
        <div class="form-group">
            <label for="platformName">Nombre de la Plataforma</label>
            <input type="text" id="platformName" name="platformName" required>
        </div>

        <div class="form-group <?php echo ALINEACION_CENTRO; ?>">
            <button type="submit" name="createPlatform">Crear</button>
        </div>
    </form>

    <?php
    // Verificar si el formulario fue enviado y procesado
    if (isset($_POST['createPlatform'])) {  // Corregir el nombre del campo
        // Obtener el nombre de la plataforma
        $platformName = $_POST['platformName'];

        // Verificar si el nombre de la plataforma no está vacío
        if (!empty($platformName)) {
            // Asegúrate de que la variable $plataformas esté instanciada correctamente
            // Supongamos que tienes una clase Platform con el método create()
            $plataformas->create($platformName);  // Llamar al método create

            // Mensaje de éxito
            echo "<div class='alert alert-success'>¡Plataforma '$platformName' creada con éxito!</div>";
        } else {
            // Mensaje de error si el campo está vacío
            echo "<div class='alert alert-danger'>Por favor, ingrese un nombre de plataforma.</div>";
        }
    }
    ?>
</div>
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
</html>