<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();
$sql = "
        INSERT INTO `categories`
        SET `parent_id` = :parent_id, `name` = :name_category
      ";

      $set = $PDO->PDO->prepare($sql);
      $response['res'] = $set->execute($requestData);