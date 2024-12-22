<?php
require_once '../Models/DirectoresModel.php';

class DirectoresController {

    private $directores;

    public function __construct() {
        // Create an instance of the directores model
        $this->directores = new directores();;
    }

    // Handle the CREATE action (Add a new platform)
    public function create($name) {
        if (!empty($name)) {
            // Call the create method from the directores model
            $this->directores->create($name);
        } else {
            // You can handle errors here or return them if needed
            return "Error: Name cannot be empty.";
        }
    }

    // Handle the READ action (Get all platforms)
    public function getAll() {
        // Call the getAll method from the directores model
        return $this->directores->getAll();
    }

    // Handle the READ action (Get a platform by ID)
    public function getById($id) {
        // Call the getById method from the directores model
        return $this->directores->getById(strval($id));
    }

    // Handle the UPDATE action (Update a platform by ID)
    public function update($id, $name) {
        if (!empty($name)) {
            // Call the update method from the directores model
            $this->directores->update($id, $name);
        } else {
            // You can handle errors here or return them if needed
            return "Error: Name cannot be empty.";
        }
    }

    // Handle the DELETE action (Delete a platform by ID)
    public function delete($id) {
        // Call the delete method from the directores model
        $this->directores->delete($id);
    }
}
?>

