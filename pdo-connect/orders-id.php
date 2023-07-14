<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();

$result = $PDO->PDO->query("
        SELECT * FROM `orders` ORDER BY `order_id` DESC LIMIT 1
");
$order = $result->fetch();