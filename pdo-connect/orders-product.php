<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();

$result = $PDO->PDO->query("
        SELECT * FROM `products_in_order`
    ");
    
    $products_in_order = array();

    while ($products_in_orderInfo = $result->fetch()){
        $products_in_order[]= $products_in_orderInfo;
    }