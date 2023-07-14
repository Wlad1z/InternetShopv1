<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    
  $requestDataClient['fio'] = $_POST['fio'];
  $requestDataClient['phone'] = $_POST['phone'];
  $requestDataClient['email'] = $_POST['email'];
  $requestDataClient['comment'] = $_POST['comment'];
  $requestDataClient['summa'] = $_POST['summa'];
  $requestDataClient['date'] = date("d-m-Y H:i:s");
  $requestDataProduct['name'] = $_POST['name'];
  $requestDataProduct['id'] = $_POST['id'];
  $requestDataProduct['price'] = $_POST['price'];
  $requestDataProduct['quantity'] = $_POST['quantity'];
  $requestDataProduct['date'] = date("d-m-Y H:i:s");
  
    
    $errors = array();

    if (!$requestDataClient['fio'])
		$errors[] = 'Поле "Ваше имя" обязательно для заполнения';
    
    if (!$requestDataClient['phone'] && !$requestDataClient['email'])
		$errors[] = 'Вы должны заполнить как минимум одно поле "Телефон" или "Email"';

    if (!$requestDataProduct['id'])
    $errors[] = 'Не указан ID товара';

    $ids = explode("-",$requestDataProduct['id']);
    $quantitys = explode(";",$requestDataProduct['quantity']);
    $names = explode("-",$requestDataProduct['name']);
    $prices = explode(";",$requestDataProduct['price']);
   

    
    $response = array();

    if ($errors) {
		  $response['errors'] = $errors;
    } else{

      include 'models/orders-client.php';
      include 'pdo-connect/orders-id.php';
      $orderId = $order['order_id'];
      $requestDataProduct['order_id'] = $orderId;
      $i = 0;
      foreach ($ids as $id):
        if (empty($id)){break;};
          $requestDataProduct['id'] = $id;
          $requestDataProduct['name'] = $names[$i];
          $requestDataProduct['quantity'] = $quantitys[$i];
          $requestDataProduct['price'] = $prices[$i];
          include 'models/orders-product.php';
          $i+=1;
      endforeach;


    }

    echo json_encode($response);
   
}