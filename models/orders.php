<?php
spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();
$sql = "
        INSERT INTO `orders`
        SET `fio` = :fio, `phone` = :phone, `email` = :email, `comment` = :comment, `product_id` =:id, `name` =:name, `price` =:price
      ";

      $set = $PDO->PDO->prepare($sql);
      $response['res'] = $set->execute($requestData);