<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();
$sql = "
        INSERT INTO `products`
        SET `category_id` = :category_id, `name` = :name_product, `price` = :price_product, `small_description` = :small_description, `big_description` = :big_description
      ";

      $set = $PDO->PDO->prepare($sql);
      $response['res'] = $set->execute($requestData);