<?php
   
    include 'components/header.php';

    if($_GET['clear_cart']){
        $_SESSION['cart']= array();
        header('Location: '.$_SERVER['PHP_SELF']);
        $_GET['clear_cart']= false; 
    }
?>

<div class="header">
    <img src="static/img/logo.jpg" alt="">
    <h2>Копейки</h2>
</div>

<?php 
    include 'components/menu-categories.php';
?>

<div class="catalog">
    <? foreach ($products as $product):?>
        <div class="card mb-3" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>">
            <img src="<?=$product['image']?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?=$product['name']?></h5>
                <p class="card-text"><?=$product['price']?> руб.</p>
                <p class="card-text"><small class="text-body-secondary"><?=$product['small_description']?></small></p>
                <button class="btn btn-success order">Заказать</button>
                <a href="product-page.php?product=<?=intId($product['id'])?>" class="btn btn-success">Подробнее</a>
            </div>
        </div>
    <?endforeach?>
</div>


<?php
    include 'components/footer.php';
?>