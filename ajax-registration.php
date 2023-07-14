<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    
  $requestData = $_POST;
  
    
    $errors = array();

    if (!$requestData['fio'])
		$errors[] = 'Поле "Ваше имя" обязательно для заполнения';
    
    if (!$requestData['phone'] && !$requestData['email'])
		$errors[] = 'Вы должны заполнить как минимум одно поле "Телефон" или "Email"';
    
    if (!$requestData['login'] && !$requestData['password'])
        $errors[] = 'Укажите ваш логин и пароль';
    
    
    $response = array();

    if ($errors) {
		  $response['errors'] = $errors;
    } else{
        include 'models/registration.php';


    }

    echo json_encode($response);
   
}