<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();

$result = $PDO->PDO->query("
        SELECT * FROM `orders`
    ");
    
    $orders = array();

    while ($ordersInfo = $result->fetch()){
        $orders[]= $ordersInfo;
    }