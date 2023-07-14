<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();

$stmt = $PDO->PDO->prepare("SELECT * FROM `comments` WHERE `product_id` = :product_id");
$stmt->bindParam(':product_id', $_GET['product']);
$stmt->execute();



while ($commentsInfo = $stmt->fetch(PDO::FETCH_ASSOC)){
    $comments[] = $commentsInfo;
}