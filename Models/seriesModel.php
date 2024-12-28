<?php
require_once "database.php";

class Series {

    private $table = "series";
    private $id;
    private $title;
    private $platformid;

    public function __construct($idSeries,$titleSeries,$idPlatform){
        $this->id = $idSeries;
        $this->title = $titleSeries;
        $this->platformid = $idPlatform; 
    }

    //Getter
    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getplatformid(){
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
        $query = "SELECT * FROM $this->table";
        $result = $mysqli->query($query);
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

        // Use prepared statement to prevent SQL injection
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

        $stmt->close();
        $mysqli->close();
        
        return $serieCreated;
    }

}

?>