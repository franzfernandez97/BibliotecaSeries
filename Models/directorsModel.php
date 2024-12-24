<?php
require_once 'database.php';

require_once '../config/config.php';

class Directores {
    private $db;
    private $table = 'directors';

    public function __construct() {

        // Load the database credentials using the simplified Config class
        $credentials = Config::getDbCredentials();

        // Create an instance of the Database class and connect to DB
        $dbInstance = new Database($credentials['host'], $credentials['user'], $credentials['password'], $credentials['dbname']);
        $connection = $dbInstance->connect();

        // If connection fails (returns an error message), exit
        if (is_string($connection)) {
            echo $connection;
            exit;
        }

        // Otherwise, set the connection
        $this->db = $connection;
    }

    // CREATE: Add a new Directors (only name)
    public function create($name) {
        $query = "INSERT INTO $this->table (name) VALUES (?)";

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param("s", $name);
            if ($stmt->execute()) {
                echo "New Directors {".$name."}added successfully.\n";
            } else {
                echo "Error: " . $stmt->error . "\n";
            }
            $stmt->close();
        }
    }

    // READ: Get all directors
    public function getAll() {
        $query = "SELECT * FROM $this->table";
        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            $directors = [];
            while ($row = $result->fetch_assoc()) {
                $directors[] = $row;
            }
            return $directors;
        } else {
            echo "No directors found.\n";
            return [];
        }
    }

    // READ: Get a specific Directors by ID
    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE id = ?";
        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                echo "Directors not found.\n";
                return null;
            }

            $stmt->close();
        }
    }

    // UPDATE: Update an existing Directors by ID
    public function update($id, $name) {
        $query = "UPDATE $this->table SET name = ? WHERE id = ?";

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param("si", $name, $id);
            if ($stmt->execute()) {
                echo "Directors updated successfully.\n";
            } else {
                echo "Error: " . $stmt->error . "\n";
            }
            $stmt->close();
        }
    }

    // DELETE: Delete a Directors by ID
    public function delete($id) {
        $query = "DELETE FROM $this->table WHERE id = ?";

        if ($stmt = $this->db->prepare($query)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "Directors deleted successfully.\n";
            } else {
                echo "Error: " . $stmt->error . "\n";
            }
            $stmt->close();
        }
    }
}

?>
