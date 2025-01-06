<?php
  require_once $_SERVER['DOCUMENT_ROOT']. '/BibliotecaSeries/models/languagesModel.php';

  function validacionTexto($input) {
    return preg_match('/^(?!\s)[\p{L}]+(?:[\p{L}\s]+)*$/u', $input);
  }

  function getAllLanguges ():array|string {
    $model = new Languages();
    try {
      $languages = $model->getAllLanguages();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $languages;
  }
  function getLanguage (int $languageId) {
    $model = new Languages(languageId: $languageId);
    try {
      $language = $model->getById();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $language;
  }
  function createLanguage (string $languageName, string $languageCode) {
    if (func_num_args() !== 2) {
      throw new InvalidArgumentException("Error funcion createSerie: Se requiere llenar todos los parametros.");
    }

    // the argument is not string?
    if (!validacionTexto($languageName) || !validacionTexto($languageCode)) {
        return "Error funcion createSerie: Los parametros no pueden ser numeros ni caracteres especiales.";
    }
    $model = new Languages(languageName: $languageName, languageCode: $languageCode);
    try {
      $language = $model->createLanguage();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $language;
  }
  function editLanguage(int $languageId, string $languageName, string $languageCode) {
    $model = new Languages(languageId: $languageId, languageName: $languageName, languageCode: $languageCode);
    try {
      $language = $model->editLanguage();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $language;
  }
  function deleteLanguage(int $languageId) {
    $model = new Languages(languageId: $languageId);
    try {
      $language = $model->deleteLanguage();
      return $language ? true : false;
    }catch (Exception $error) {
      return $error->getMessage();
    }
  }


?>
