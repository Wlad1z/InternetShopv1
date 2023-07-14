<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    
  $requestData = $_POST;
  $requestData['date'] = date("d-m-Y");
  $requestData['time'] = date("H:i:s");
    
    $errors = array();

    if (!$requestData['product_id'])
		$errors[] = 'Ошибка id';
    
    if (!$requestData['login'])
        $errors[] = 'Ошибка login';

    if (!$requestData['body_comment'])
        $errors[] = 'Пустой комментарий';
    
    $response = array();

    if ($errors) {
		  $response['errors'] = $errors;
    } else{
        include 'models/addComment.php';
    }

    echo json_encode($response);
    
}