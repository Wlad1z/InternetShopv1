<?php

    include 'components/header.php';

    foreach ($products as $product):
        if ($product['id']==$_GET['addtocart']){
            $_SESSION['cart'][]=$product;
            header('Location: '.$_SERVER['PHP_SELF']);
        }
    endforeach;
    foreach ($_SESSION['cart'] as $car):
        ?>
            <h5><?=$car['name']?></h5>
            
        <?php
    endforeach;
    foreach ($_SESSION['cart'] as $car):
        $sum +=$car['price'];
    endforeach;
    echo $sum;
?>  
<div class="card" data-id="<?php
    foreach ($_SESSION['cart'] as $car):
        echo $car['id'];
    endforeach;
?>" data-name="<?php
    foreach ($_SESSION['cart'] as $car):
        echo $car['name'].' ';
    endforeach;
?>" data-price="<?= $sum?>">
    <button class="btn btn-success order ">Заказать</button>
    <a href="index.php?clear_cart=true" class="btn btn-success clear_cart">Очистить корзину</a>
</div>
    
<?php
    include 'components/footer.php';
?>