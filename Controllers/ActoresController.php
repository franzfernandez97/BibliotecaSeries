<?php
  require_once '../Models/ActoresModel.php';
  class ActoresController {
    private $actorModel;
    public function __construct() {
      $this->actorModel = new Actores();
    }
    public function getAll():array {
      return $this->actorModel->getAll();
    }
    public function getById(int $id):array|string {
      $result = $this->actorModel->getById($id);
      if($result){
        return $result;
      }
      return "No se encontró el actor";
    }
  }

?>
