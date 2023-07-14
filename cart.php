<?php
    $header = "Заказ";
    $count = 0;
    $delete = false;
    include 'components/header.php';

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        foreach ($products as $product):
            if ($product['id']==$_GET['addtocart']){
                $_SESSION['cart'][]=$product;
            }
        endforeach;
        foreach ($_SESSION['cart'] as $key => $value):
            if ($value['id'] == $_GET['deltocart'])
            {
                if ($delete == true) 
                    {break;};
                unset ($_SESSION['cart'][$key]);
                $delete = true;    
            }
        endforeach;
        sort($_SESSION['cart']);
    }
    $unis = array();
    foreach ($_SESSION['cart'] as $car):
        $unis[]=$car['id'];
    endforeach;
    
    $unis = array_count_values($unis);
?>
<div class="header">
    <img src="static/img/logo.jpg" alt="">
    <h2><?php echo $header?></h2>
</div>

<div class="orders">
<?php
     
    
    foreach ($unis as $key => $value):
        foreach ($products as $product):
            if ($product['id']==$key){
                $count +=1;
                
                ?>
                    <div>
                        
                        <div class="cart-order">
                            <div class="order-info blok-1">
                                <h1><?= $count.'. '.$product['name']?></h1>
                            </div>
                            <div class="order-info blok-2">
                                <h1><button class="btn btn-success delCart" data-id="<?=$product['id']?>">-</button></h1>
                                <h1><?=$value?></h1>
                                <h1><button  class="btn btn-success addCart" data-id="<?=$product['id']?>">+</button></h1>
                            </div>
                            <div class="order-info blok-3">
                                <h2><span id="count<?=$product['id']?>"><?= number_format(($price = ($product['price']*$value)), 0, ' ', ' ')?></span>руб;</h2>
                            </div>   
                        </div>
                        
                    </div>
                    
                <?php
            $sum +=$price;
            }
        endforeach;
    endforeach;
    if (empty($_SESSION['cart'])){
        echo "<h1>Пусто</h1>";
    }
    if (!empty($_SESSION['cart'])){
        $summa = $sum;
        $sum = number_format($sum, 0, ' ', ' ');
        echo "<h1>Итого <span id='sum'> $sum</span> руб.</h1>";
    }
    
    print_r($unis)
?>  
</div>




<div class="card order-buttons" data-id="<?php
    foreach ($unis as $key => $value):
        foreach ($products as $product):
            if ($product['id']==$key)
                echo $product['id'].'-';
        endforeach;
    endforeach;
?>" data-name="<?php
    foreach ($unis as $key => $value):
        foreach ($products as $product):
            if ($product['id']==$key)
                echo $product['name'].'-';
        endforeach;
    endforeach;
?>" data-price="<?php
    foreach ($unis as $key => $value):
        foreach ($products as $product):
            if ($product['id']==$key)
                echo $value*$product['price'].";";
        endforeach;
    endforeach;
?>" data-quantity="<?php 
    foreach ($unis as $key => $value):
        foreach ($products as $product):
            if ($product['id']==$key)
                echo $value.';';
        endforeach;
endforeach;
?>" data-summa="<?=$summa
?>">
    <button class="btn btn-success order-button order">Заказать</button>
    <a href="index.php?clear_cart=true" class="btn btn-success clear_cart order-button">Очистить корзину</a>
</div>
    
<?php
    include 'components/footer.php';
?>