<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $requestData = $_POST;

    $errors = array();

    if(!$requestData['id'])
    $errors[] = 'Не получен ID товара.';

    if (!$requestData['fio'])
		$errors[] = 'Поле "Ваше имя" обязательно для заполнения';
    
    if (!$requestData['phone'] && !$requestData['email'])
		$errors[] = 'Вы должны заполнить как минимум одно поле "Телефон" или "Email"';

    $response = array();

    if ($errors) {
		  $response['errors'] = $errors;
    } else{

    include 'models/orders.php';

      if ($response['res']){
        $message = "
          Оформлен новый заказ.
          Заказан товар с ID - ".$requestData['id']." ".$requestData['name']." цена ".$requestData['price']." клиент ".$requestData['fio'];
        
        mail('vladislav.demynow@mail.ru', 'Оформлен новый заказ.', $message, 'FROM: admin@internetshop.ru');
      }
    }

    echo json_encode($response);
   
}