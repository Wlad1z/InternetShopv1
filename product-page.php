<?php

    include 'components/header.php';

    include 'components/menu-categories.php';

    
    foreach ($products as $product):
        if ($product['id']==$_GET['product']){
        ?>
            <div class="card mb-3" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>">
                <img src="<?=$product['image']?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$product['name']?></h5>
                    <p class="card-text"><?=$product['price']?> руб.</p>
                    <p class="card-text"><?=$product['big_description']?></p>
                    <button class="btn btn-success order">Заказать</button>
                    <a href="cart.php?addtocart=<?=$product['id']?>" class="btn btn-success addCart" id="addCart<?=$product['id']?>">Добавить в заказ</a>
                </div>
            </div>
    <?php
        }
    endforeach;

    include 'components/footer.php';
?>
