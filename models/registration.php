<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();
$sql = "
        INSERT INTO `users`
        SET `fio` = :fio, `login` = :login, `password` = :password, `email` = :email, `phone` = :phone
      ";

      $set = $PDO->PDO->prepare($sql);
      $response['res'] = $set->execute($requestData);