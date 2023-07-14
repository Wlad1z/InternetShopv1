<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();
$sql1 = "
        INSERT INTO `orders`
        SET `client_name` = :fio, `client_phone` = :phone, `client_email` = :email, `comment` = :comment,`order_date` =:date, `summa_order` =:summa
      ";

      $set1 = $PDO->PDO->prepare($sql1);
      $response['res'][] = $set1->execute($requestDataClient);