<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});

$PDO = PdoConnect::getInstance();

$stmt = $PDO->PDO->prepare("SELECT * FROM `gallery_products` WHERE `product_id` = :product_id");
$stmt->bindParam(':product_id', $_GET['product']);
$stmt->execute();



while ($galleryInfo = $stmt->fetch(PDO::FETCH_ASSOC)){
    $gallery[] = $galleryInfo;
}