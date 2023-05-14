<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

$requestData = $_POST;

      $errors = array();

      if(!$requestData['name_category'])
      $errors[] = 'Не указано название категории.';
      

      $response = array();

      if ($errors) {
      $response['errors'] = $errors;
      } else{

      include 'models/addCategories.php';

      }

      echo json_encode($response);
}