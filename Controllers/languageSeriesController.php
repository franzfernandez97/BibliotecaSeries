<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/BibliotecaSeries/models/languageSeriesModel.php';

  function getLanguagesBySerie($serieId) {
    $model = new LanguageSeries(serieId: $serieId);
    try {
      $result = $model->getLanguagesBySerie();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $result;
  }
  function getSeriesByLanguage($languageId) {
    $model = new LanguageSeries(languageId: $languageId);
    try {
      $result = $model->getSeriesByLanguage();
    }catch (Exception $error) {
      return $error->getMessage();
    }
    return $result;
  }
  function addRelationships($languageId, $series, $languageTypes){
    $model = new LanguageSeries(languageId: $languageId);
    try {
      $model->addRelationship($series, $languageTypes);
    }catch (Exception $error) {
      return $error->getMessage();
    }
  }
  function updateRelationship($languageId, $seriesId, $languagesType) {
    $model = new LanguageSeries(languageId: $languageId);
    try {
      $model->updateRelationship($seriesId, $languagesType);
    }catch (Exception $error) {
      return $error->getMessage();
    }
  }
  function getSeriesAudio($languageId) {
    $model = new LanguageSeries(languageId: $languageId);
    try {
      $result = $model->getSeriesAudio();
      return $result;
    }catch (Exception $error) {
      return $error->getMessage();
    }
  }
  function getSeriesSubtitle($languageId) {
    $model = new LanguageSeries(languageId: $languageId);
    try {
      $result = $model->getSeriesSubtitle();
      return $result;
    }catch (Exception $error) {
      return $error->getMessage();
    }
  }
?>
