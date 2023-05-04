<?php

    include 'components/header.php';

    include 'models/products.php';

    spl_autoload_register(function($class){
        include 'classes/'. $class. '.php';
    });
    $PDO = PdoConnect::getInstance();
    $_GET['product'] = intval($_GET['product'])
?>

<? foreach ($products as $product):
    if ($product['id']==$_GET['product']){
    ?>
        <div class="card mb-3" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>">
            <img src="<?=$product['image']?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?=$product['name']?></h5>
                <p class="card-text"><?=$product['price']?> руб.</p>
                <p class="card-text"><?=$product['big_description']?></p>
                <button class="btn btn-success order">Заказать</button>
            </div>
        </div>
<?
    };
endforeach?>

<?php
    $page = $PDO->PDO->query("
    SELECT * FROM `products` WHERE id = '{$_GET['product']}'
");
    $car = array();
    while ($pagetInfo = $page->fetch()){
        $car[]= $pagetInfo;
    }
    print_r($car)
?>
    <div class="card mb-3" data-id="<?=$car['id']?>" data-name="<?=$car['name']?>" data-price="<?=$car['price']?>">
            <img src="<?=$car['image']?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?=$car['name']?></h5>
                <p class="card-text"><?=$car['price']?> руб.</p>
                <p class="card-text"><?=$car['big_description']?></p>
                <button class="btn btn-success order">Заказать</button>
            </div>
        </div>



<?php
    include 'components/footer.php';
?>
