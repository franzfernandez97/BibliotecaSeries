<?php
class Database{
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $connection;

    public function __construct($host, $user, $password, $dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    // metodo para conectar a la DB
    public function connect() {

        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        
        if ($this->connection->connect_error) {
            return "Error: " . $this->connection->connect_error; // Return error message
        }
        // si conexion es exitosa
        return $this->connection; // Connection successful
    }

    // Metodo para obtener conexion
    public function getConnection() {
        return $this->connection;
    }

    // Metodo para cerra conexion
    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }

}