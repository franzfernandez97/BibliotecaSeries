<?php
function databaseConnect(): mysqli | string{
  // Credenciales de conexión
  $host = "dbseries.c7yks6yyy5jl.us-east-2.rds.amazonaws.com"; // Endpoint de la base de datos en AWS
  $usuario = "admin";       // Usuario de la base de datos
  $clave = "admin123456";
  $dbName = "db_biblioteca_series";
  // Conexión
  $conn = new mysqli($host, $usuario, $clave, $dbName);

  // Verificar conexión
  if ($conn->connect_error) {
      return "Error en la conexión: " . $conn->connect_error;
  }
  return $conn;
}
function createTables():void {
  $connection = databaseConnect();
  try {
    $connection->execute_query("CREATE TABLE IF NOT EXISTS Idiomas (
          ID INT AUTO_INCREMENT PRIMARY KEY,
          Nombre VARCHAR(255) NOT NULL,
          ISOCodigo VARCHAR(10) NOT NULL UNIQUE
      );
    ");
    $connection->execute_query("CREATE TABLE IF NOT EXISTS Idiomas_Series (
        id_idioma INT,
        id_serie INT,
        PRIMARY KEY (id_idioma, id_serie),
        FOREIGN KEY (id_idioma) REFERENCES Idiomas(ID) ON DELETE CASCADE,
        FOREIGN KEY (id_serie) REFERENCES Series(ID) ON DELETE CASCADE
      );
    ");
    $connection->execute_query("CREATE TABLE IF NOT EXISTS Actores (
          ID INT AUTO_INCREMENT PRIMARY KEY,
          Nombre VARCHAR(255) NOT NULL,
          Apellidos VARCHAR(255) NOT NULL,
          FechaNacimiento DATE NOT NULL,
          Nacionalidad VARCHAR(255) NOT NULL
      );
    ");
    $connection->execute_query("CREATE TABLE IF NOT EXISTS  Actores_Series (
        id_actor INT,
        id_serie INT,
        PRIMARY KEY (id_actor, id_serie),
        FOREIGN KEY (id_actor) REFERENCES Actores(ID) ON DELETE CASCADE,
        FOREIGN KEY (id_serie) REFERENCES Series(ID) ON DELETE CASCADE
      );
    ");
    echo "<h1>Se creo la tabla</h1>";
  } catch(mysqli_sql_exception $e) {
    echo "". $e->getMessage() ."";
  }
}
function inputActorData($data):void {
  $connection = databaseConnect();

  try {
    $query = $connection->prepare("
      INSERT INTO Actores (Nombre, Apellidos, FechaNacimiento, Nacionalidad) VALUES (?,?,?,?)
    ");
    if (!$query) {
      die("Error al preparar la consulta: " . $connection->error);
    };
    foreach ($data as $dato){
      $query->bind_param("ssds",$dato[0], $dato[1], $dato[2], $dato[3]);
      $query->execute();
    };
    echo "<h1>Se ha añadido correctamente los datos</h1>";

  }catch(mysqli_sql_exception $e) {
    echo "". $e->getMessage() ."";
  }
}

function deleteTables(): void {

}

$datos = [
  ["Juan", "Pérez", "1990-05-15", "Mexico"],
  ["María", "García", "1985-03-20", "Colombia"],
  ["Carlos", "López", "2000-12-10", "Argentina"],
  ["Ana", "Martínez", "1992-07-25", "Chile"],
  ["Pedro", "Hernández", "1988-09-30", "Peru"],
  ["Lucía", "Fernández", "1995-01-10", "Venezuela"],
  ["Diego", "Ramírez", "1983-11-18", "Uruguay"],
  ["Sofía", "Castro", "1998-04-05", "Ecuador"],
  ["Luis", "González", "1993-06-22", "Panama"],
  ["Valeria", "Morales", "1987-02-14", "Bolivia"],
  ["Andrés", "Torres", "1991-08-12", "Paraguay"],
  ["Camila", "Rojas", "1996-03-29", "Costar rica"],
  ["Jorge", "Medina", "1982-12-01", "Salvador"],
  ["Paula", "Ortega", "1997-10-08", "Guatemala"],
  ["Fernando", "Ruiz", "1989-09-15", "Honduras"]
];

inputActorData($datos);
//createTables();
?>
