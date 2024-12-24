<?php

// Función para conectar a la base de datos
function connect_to_db($host, $user, $password) {
    // Intentamos conectar a la base de datos MySQL
    $connection = new mysqli($host, $user, $password);

    // Comprobamos si la conexión fue exitosa
    if ($connection->connect_error) {
        // Si hubo un error en la conexión, lo mostramos
        return "Error: " . $connection->connect_error;
    }

    // Si la conexión fue exitosa
    return "Successfully connected to the database.";
}

// Función que llama a la conexión y muestra el estado en una etiqueta <h2>
function display_connection_status($host, $user, $password) {
    // Llamamos a la función de conexión
    $status = connect_to_db($host, $user, $password);

    // Imprimimos el estado de la conexión dentro de una etiqueta <h2>
    echo "<h2>$status</h2>";
}

// Parámetros de conexión
$host = 'dbseries.c7yks6yyy5jl.us-east-2.rds.amazonaws.com';  // Dirección del servidor
$user = 'admin';    // Usuario de la base de datos
$password = 'admin123456'; // Contraseña del usuario

// Llamamos a la función para mostrar el estado
display_connection_status($host, $user, $password);

?>
