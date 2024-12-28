<?php

require_once 'database.php';

class Platform {
    private $id;
    private $name;
    private $table = "platforms";

    public function __construct($idPlatform, $namePlatform) {

        $this->id = $idPlatform;
        $this->name = $namePlatform;

    }

    //GETTER
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    // SETTER
    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    // READ: Get all platforms
    public function getAll() {
        $mysqli = Database::getDbConnection();
        $query = "SELECT * FROM $this->table";
        $result = $mysqli->query($query);
        $listData = [];

        if ($result->num_rows > 0) {
            foreach ($result as $item){
                $itemObject = new Platform($item['id'], $item['name']);
                array_push($listData, $itemObject);
            }
        }
        $mysqli->close();
        return $listData;
    }

    public function create(){
        $platformCreated = false;
        $mysqli = Database::getDbConnection();

        // Use prepared statement to prevent SQL injection
        $stmt = $mysqli->prepare("SELECT name FROM $this->table WHERE name = ?");
        $stmt->bind_param("s", $this->name);  // 's' denotes that we're passing a string

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows <= 0) {

            //if dont exits its going to create it
            $insertStmt = $mysqli->prepare("INSERT INTO $this->table (name) VALUES (?)");
            $insertStmt->bind_param("s", $this->name);

            if ($insertStmt->execute()) {
                $platformCreated = true;  // Platform created successfully
            }
        }

        $stmt->close();
        $mysqli->close();
        return $platformCreated;
    }

    public function update() {
        $platformUpdated = false;
        $mysqli = Database::getDbConnection();
    
        // Prepare the update statement to prevent SQL injection
        $stmt = $mysqli->prepare("UPDATE $this->table SET name=? WHERE id = ?");
        $stmt->bind_param("si", $this->name, $this->id);  // 's' for string (name), 'i' for integer (id)
        
        // Execute the statement
        if ($stmt->execute()) {
            // Check if any row was affected (i.e., if the update was successful)
            if ($stmt->affected_rows > 0) {
                $platformUpdated = true;
            } else {
                // No rows were updated (perhaps the id doesn't exist or name is unchanged)
                $platformUpdated = false;
            }
        }
        $stmt->close();
        $mysqli->close();
        
        return $platformUpdated;
    }

    public function getItem(){
        $mysqli = Database::getDbConnection();
        // Use prepared statement to prevent SQL injection
        $stmt = $mysqli->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->bind_param("i", $this->id);  // 's' denotes that we're passing a string

        $stmt->execute();
        $result = $stmt->get_result();

        //if exist a result
        if ($result->num_rows > 0){
            foreach ($result as $item){
                $itemObject = new Platform($item["id"], $item["name"]);
                return $itemObject;
            }
        }
        return false;
    }

}
?>
