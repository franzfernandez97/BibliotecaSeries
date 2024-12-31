<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BibliotecaSeries/config/Config.php';

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

    // connect to DB
    public function connect() {

        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            return "Error: " . $this->connection->connect_error; // Return error message
        }

        return $this->connection; // Connection successful
    }

    // getConnection
    public function getConnection() {
        return $this->connection;
    }

    // closeConnection
    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }


    public static function getDbConnection() {
        // Load the database credentials using the simplified Config class
        $credentials = Config::getDbCredentials();

        // Create an instance of the Database class
        $dbInstance = new self($credentials['host'], $credentials['user'], $credentials['password'], $credentials['dbname']);

        // Connect to the database
        $connection = $dbInstance->connect();

        // If connection fails, return the error message
        if (is_string($connection)) {
            return $connection;
            //exit; // Stop execution
        }

        // Return the successful connection
        return $connection;
    }

}
?>
