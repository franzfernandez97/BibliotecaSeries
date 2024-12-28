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

//     // CREATE: Add a new platform (only name)
//     public function create($name) {
//         $query = "INSERT INTO $this->table (name) VALUES (?)";

//         if ($stmt = $this->db->prepare($query)) {
//             $stmt->bind_param("s", $name);
//             if ($stmt->execute()) {
//                 echo "New platform {".$name."}added successfully.\n";
//             } else {
//                 echo "Error: " . $stmt->error . "\n";
//             }
//             $stmt->close();
//         }
//     }


//     // READ: Get a specific platform by ID
//     public function getById($id) {
//         $query = "SELECT * FROM $this->table WHERE id = ?";
//         if ($stmt = $this->db->prepare($query)) {
//             $stmt->bind_param("i", $id);
//             $stmt->execute();
//             $result = $stmt->get_result();

//             if ($result->num_rows > 0) {
//                 return $result->fetch_assoc();
//             } else {
//                 echo "Platform not found.\n";
//                 return null;
//             }

//             $stmt->close();
//         }
//     }

//     // UPDATE: Update an existing platform by ID
//     public function update($id, $name) {
//         $query = "UPDATE $this->table SET name = ? WHERE id = ?";

//         if ($stmt = $this->db->prepare($query)) {
//             $stmt->bind_param("si", $name, $id);
//             if ($stmt->execute()) {
//                 echo "Platform updated successfully.\n";
//             } else {
//                 echo "Error: " . $stmt->error . "\n";
//             }
//             $stmt->close();
//         }
//     }

//     // DELETE: Delete a platform by ID
//     public function delete($id) {
//         $query = "DELETE FROM $this->table WHERE id = ?";

//         if ($stmt = $this->db->prepare($query)) {
//             $stmt->bind_param("i", $id);
//             if ($stmt->execute()) {
//                 echo "Platform deleted successfully.\n";
//             } else {
//                 echo "Error: " . $stmt->error . "\n";
//             }
//             $stmt->close();
//         }
//     }
}
?>
