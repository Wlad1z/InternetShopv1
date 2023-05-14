<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    
    $requestData = $_POST;

    $errors = array();

    if(!$requestData['category_id'])
    $errors[] = 'Не указана категория товара.';

    if (!$requestData['name_product'])
    $errors[] = 'Не указано название товара.';
    
    if (!$requestData['price_product'])
    $errors[] = 'Не указана цена товара.';

    if (!$requestData['small_description']|| !$requestData['big_description'])
    $errors[] = 'Введите краткое и полное описание товара.';

    $response = array();

    if ($errors) {
    $response['errors'] = $errors;
    } else{

    include 'models/addProducts.php';

    }

    echo json_encode($response);
    
    
      
      
}
    