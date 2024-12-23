<?php
require_once '../Models/LenguajesModel.php';

class LenguajesController {

    private $lenguajes;

    public function __construct() {
        // Create an instance of the lenguajes model
        $this->lenguajes = new lenguajes();;
    }

    // Handle the CREATE action (Add a new platform)
    public function create($name) {
        if (!empty($name)) {
            // Call the create method from the lenguajes model
            $this->lenguajes->create($name);
        } else {
            // You can handle errors here or return them if needed
            return "Error: Name cannot be empty.";
        }
    }

    // Handle the READ action (Get all platforms)
    public function getAll() {
        // Call the getAll method from the lenguajes model
        return $this->lenguajes->getAll();
    }

    // Handle the READ action (Get a platform by ID)
    public function getById($id) {
        // Call the getById method from the lenguajes model
        return $this->lenguajes->getById(strval($id));
    }

    // Handle the UPDATE action (Update a platform by ID)
    public function update($id, $name) {
        if (!empty($name)) {
            // Call the update method from the lenguajes model
            $this->lenguajes->update($id, $name);
        } else {
            // You can handle errors here or return them if needed
            return "Error: Name cannot be empty.";
        }
    }

    // Handle the DELETE action (Delete a platform by ID)
    public function delete($id) {
        // Call the delete method from the lenguajes model
        $this->lenguajes->delete($id);
    }
}
?>

