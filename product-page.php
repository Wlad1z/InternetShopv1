<?php
    include 'models/products.php';
    foreach ($products as $product):
        if ($product['id']==$_GET['product']){
            $header = $product['name'];
        }
    endforeach;
    
    include 'components/header.php';
?>
<div class="header">
    <h2><?php echo $header?></h2>
</div>
<div class="content ">
    <?php

    include 'components/menu-categories.php';

    
    foreach ($products as $product):
        if ($product['id']==$_GET['product']){
        ?>
            <div class="card mb-3" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>">
                <img src="static/img/<?=$product['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    
                    <h4 class="card-text"><?=number_format($product['price'], 0, ' ', ' ');?> руб.</h4>
                    <p class="card-text"><?=$product['big_description']?></p>
                    <button class="btn btn-success order">Заказать</button>
                    <a href="cart.php?addtocart=<?=$product['id']?>" class="btn btn-success addCart" id="addCart<?=$product['id']?>">Добавить в заказ</a>
                </div>
            </div>
</div>
    <?php
        }
    
    endforeach;
    
    include 'components/footer.php';
?>
