<?php
    $header = "Копейки";
    include 'components/header.php';

    if($_GET['clear_cart']){
        $_SESSION['cart']= array();
        header('Location: '.$_SERVER['PHP_SELF']);
        $_GET['clear_cart']= false; 
    }
    
?>

<div class="header">
    <img src="static/img/logo.jpg" alt="">
    <h2><?php echo $header?></h2>
</div>

<div class="content">
    <?php 
        include 'components/menu-categories.php';
    ?>

    <div class="catalog">
        <? foreach ($products as $product):?>
            <div class="card mb-3 product" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>">
                <img src="static/img/<?=$product['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$product['name']?></h5>
                    <p class="card-text"><?=number_format($product['price'], 0, ' ', ' ')?> руб.</p>
                    <p class="card-text"><small class="text-body-secondary"><?=$product['small_description']?></small></p>
                    <div class="product-buttons">
                        <button class="btn btn-success order">Купить</button>
                        <a href="#" onclick="return false" class="btn btn-success addCart" data-id="<?=$product['id']?>">В заказ</a>
                        <a href="product-page.php?product=<?=intId($product['id'])?>" class="btn btn-success">Подробнее</a>
                    </div>
                    
                </div>
            </div>
        <?endforeach?>
    </div>
</div>

<?php
    include 'components/footer.php';
?>