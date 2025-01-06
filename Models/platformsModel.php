<?php

require_once 'database.php';

class Platform {
    private $id;
    private $name;
    private $table = "platforms";

    public function __construct($idPlatform = null, $namePlatform = null) {

        $this->id = $idPlatform;
        $this->name = $namePlatform;

    }

    //GETTER
    public function getId():int{
        return (int)$this->id;
    }

    public function getName():string{
        return (string)$this->name;
    }

    // SETTER
    public function setId(int $id):void{
        $this->id = $id;
    }

    public function setName(string $name):void{
        $this->name = $name;
    }

    // READ: Get all platforms
    public function getAll():array {
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
            throw new Exception("Error al conectar con la base de datos: ". $mysqli);
        }

        $query = "SELECT * FROM $this->table";
        try {
            $result = $mysqli->query(query: $query);
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
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
        // Get the error message from the database connection
        if(is_string($mysqli)){
            throw new Exception("Error al conectar con la base de datos: ". $mysqli);
        }

        // Use prepared statement to prevent SQL injection
        try{
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
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        $stmt->close();
        $mysqli->close();
        return $platformCreated;
    }

    public function update() {
        $platformUpdated = false;
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
            throw new Exception("Error al conectar con la base de datos: ". $mysqli);
        }

        // Prepare the update statement to prevent SQL injection
        try {
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
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        $stmt->close();
        $mysqli->close();
        
        return $platformUpdated;
    }

    public function getItem(){
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
            throw new Exception("Error al conectar con la base de datos: ". $mysqli);
        }
        
        // Use prepared statement to prevent SQL injection
        try {
            $stmt = $mysqli->prepare("SELECT * FROM $this->table WHERE id = ?");
            $stmt->bind_param("i", $this->id);  // 's' denotes that we're passing a string

            $stmt->execute();
            $result = $stmt->get_result();
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        //if exist a result
        if ($result->num_rows > 0){
            foreach ($result as $item){
                $itemObject = new Platform($item["id"], $item["name"]);
                return $itemObject;
            }
        }
        return false;
    }


    public function delete(){
        $deleted = false;
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
            throw new Exception("Error al conectar con la base de datos: ". $mysqli);
        }

        //prepate statement to Prevent sql injection
        try {
            $stmt = $mysqli->prepare("DELETE FROM $this->table WHERE id = ?");
            $stmt->bind_param("i", $this->id);

            //execute the statement
            if ($stmt->execute()){
                //check rows
                if($stmt->affected_rows > 0){
                    $deleted = true; //record succesfully deleted
                }else {
                    // No rows were updated (perhaps the id doesn't exist or name is unchanged)
                    $deleted = false;
                }
            }
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        // Close the statement and connection
        $stmt->close();
        $mysqli->close();

        return $deleted;
    }
}
?>
