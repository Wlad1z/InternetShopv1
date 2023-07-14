<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();
$sql = "
      INSERT INTO `comments`
      SET `product_id` = :product_id, `login` = :login, `body_comment` = :body_comment, `date` = :date, `time` = :time
      ";

      $set = $PDO->PDO->prepare($sql);
      $response['res'] = $set->execute($requestData);