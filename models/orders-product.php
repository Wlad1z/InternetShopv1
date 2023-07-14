<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();
$sql2 = "
        INSERT INTO `products_in_order`
        SET `product_id` = :id,`order_id` = :order_id, `product_name` = :name, `quantity` = :quantity, `summa` = :price, `order_date` =:date
      ";

      $set2 = $PDO->PDO->prepare($sql2);
      $response['res'][] = $set2->execute($requestDataProduct);