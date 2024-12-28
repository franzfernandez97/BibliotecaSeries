<?php
require_once "../../models/platformsModel.php";

function listPlatforms(){
    $model = new Platform(null, null);
    $plataformList = $model->getAll();
    return $plataformList;
}

function createPlatform ($namePlatform){
    $model = new Platform(null, $namePlatform);
    $isCreated = $model->create();
    return $isCreated ;
 

}
//class PlataformaController {

//     private $plataforma;

//     public function __construct() {
//         // Create an instance of the Plataforma model
//         $this->plataforma = new Platform();;
//     }

//     // Handle the CREATE action (Add a new platform)
//     public function create($name) {
//         if (!empty($name)) {
//             // Call the create method from the Plataforma model
//             $this->plataforma->create($name);
//         } else {
//             // You can handle errors here or return them if needed
//             return "Error: Name cannot be empty.";
//         }
//     }

//     // Handle the READ action (Get all platforms)
//     public function getAll() {
//         // Call the getAll method from the Plataforma model
//         return $this->plataforma->getAll();
//     }

//     // Handle the READ action (Get a platform by ID)
//     public function getById($id) {
//         // Call the getById method from the Plataforma model
//         return $this->plataforma->getById(strval($id));
//     }

//     // Handle the UPDATE action (Update a platform by ID)
//     public function update($id, $name) {
//         if (!empty($name)) {
//             // Call the update method from the Plataforma model
//             $this->plataforma->update($id, $name);
//         } else {
//             // You can handle errors here or return them if needed
//             return "Error: Name cannot be empty.";
//         }
//     }

//     // Handle the DELETE action (Delete a platform by ID)
//     public function delete($id) {
//         // Ensure $id is an integer
//         $id = intval($id);
//         // Call the delete method from the Plataforma model
//         if ($id > 0) {
//             $this->plataforma->delete($id);
//         } else {
//             echo "Invalid ID.";
//         }
//     }
// }
?>

