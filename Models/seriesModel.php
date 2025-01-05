<?php
require_once "database.php";

class Series {

    private $table = "series";
    private $id;
    private $title;
    private $platformid;

    public function __construct($idSeries = null,$titleSeries = null,$idPlatform = null){
        $this->id = $idSeries;
        $this->title = $titleSeries;
        $this->platformid = $idPlatform; 
    }

    //Getter
    public function getId():int{
        return $this->id;
    }

    public function getTitle():string{
        return $this->title;
    }

    public function getplatformid():int{
        return $this->platformid;
    }

    //Setter
    public function setId($id){
        $this->id = $id;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setplatformid($platformid){
        $this->platformid = $platformid;
    }

    // READ: Get all series
    public function getAll() {
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
            throw new Exception("Error al conectar con la base de datos: ". $mysqli);
        }

        $query = "SELECT * FROM $this->table";
        try {
            $result = $mysqli->query($query);
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        
        $listData = [];

        if ($result->num_rows > 0) {
            foreach ($result as $item){
                $itemObject = new Series($item['id'], $item['title'],  $item['platformid']);
                array_push($listData, $itemObject);
            }
        }
        $mysqli->close();
        return $listData;
    }

    public function create(){
        $serieCreated = false;
        $mysqli = Database::getDbConnection();
        // Get the error message from the database connection
        if(is_string($mysqli)){
            throw new Exception("Error al conectar con la base de datos: ". $mysqli);
        }

        // Use prepared statement to prevent SQL injection
        try{
            $stmt = $mysqli->prepare("SELECT title FROM $this->table WHERE title = ?");
            $stmt->bind_param("s", $this->title);  // 's' denotes that we're passing a string

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows <= 0) {

                //if dont exits its going to create it
                $insertStmt = $mysqli->prepare("INSERT INTO $this->table (title,platformid) VALUES (?,?)");
                $insertStmt->bind_param("si", $this->title, $this->platformid);

                if ($insertStmt->execute()) {
                    $serieCreated = true;  // Platform created successfully
                }
            }
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        $stmt->close();
        $mysqli->close();

        return $serieCreated;
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
                $itemObject = new Series($item["id"], $item["title"], $item['platformid']);
                return $itemObject;
            }
        }
        return false;
    }

    public function update() {
        $seriesUpdated = false;
        $mysqli = Database::getDbConnection();
        try {
            // Get the error message from the database connection
            if(is_string($mysqli)){
                throw new Exception("Error al conectar con la base de datos: ". $mysqli);
            }

            // Prepare the update statement to prevent SQL injection
            $stmt = $mysqli->prepare("UPDATE $this->table SET title=?,platformid = ?  WHERE id = ?");
            $stmt->bind_param("sii", $this->title, $this->platformid,$this->id);  // 's' for string (name), 'i' for integer (id)
            
            // Execute the statement
            if ($stmt->execute()) {
                // Check if any row was affected (i.e., if the update was successful)
                if ($stmt->affected_rows > 0) {
                    $seriesUpdated = true;
                } else {
                    // No rows were updated (perhaps the id doesn't exist or name is unchanged)
                    $seriesUpdated = false;
                }
            }
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        $stmt->close();
        $mysqli->close();
        
        return $seriesUpdated;
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
            // Close the statement and connection
        }catch (Exception $error) {
            throw new Exception("Error al tratar de hacer la consulta: " . $error->getMessage());
        }
        $stmt->close();
        $mysqli->close();

        return $deleted;
    }

}


?>