<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/models/actorsModel.php';
  class ActorsController {
    private $actorModel;
    public function __construct() {
      $this->actorModel = new Actors();
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
    public function createActor(array $data):string {
      $result = $this->actorModel->createActor($data);
      if($result){
        return "Se ha creado correctamente";
      }
      return "No se creó el actor";
    }
    public function updateActor(int $id,array $data):string {
      $result = $this->actorModel->updateActor($id, $data);
      if($result){
        return $result;
      }
      return "No se pudo actualizar";
    }
    public function deleteActor(int $id):string {
      $result = $this->actorModel->deleteActor($id);
      if($result){
        return "Se ha eliminado correctamente";
      }
      return "No se pudo eliminar";
    }
  }

?>
