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
                            <h1><?= $count.'. '.$product['name']?></span></h1>
                            <h1><a href="#" onclick="return false" class="btn btn-success delCart" data-id="<?=$product['id']?>">-</a></h1>
                            <h1><span class="count<?=$product['id']?>"><?=$value?></h1>
                            <h1><a href="#" onclick="return false" class="btn btn-success addCart" data-id="<?=$product['id']?>">+</a></h1>
                            
                            <h2><span id="count<?=$product['id']?>"><?= number_format(($price = ($product['price']*$value)), 0, ' ', ' ')?></span>руб;</h2>
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
        $sum = number_format($sum, 0, ' ', ' ');
        echo "<h1>Итого <span id='sum'> $sum</span> руб.</h1>";
    }
    
    print_r($unis)
?>  
</div>




<div class="card ord" data-id="<?php
    foreach ($unis as $key => $value):
        foreach ($products as $product):
            if ($product['id']==$key)
                echo $product['id'].";";
        endforeach;
    endforeach;
?>" data-name="<?php
    foreach ($unis as $key => $value):
        foreach ($products as $product):
            if ($product['id']==$key)
                echo $product['name'].";";
        endforeach;
    endforeach;
?>" data-price="<?= $sum
?>" data-quantity="<?php 
    foreach ($unis as $key => $value):
        foreach ($products as $product):
            if ($product['id']==$key)
                echo $value.";";
        endforeach;
endforeach;
?>">
    <button class="btn btn-success order ">Заказать</button>
    <a href="index.php?clear_cart=true" class="btn btn-success clear_cart">Очистить корзину</a>
</div>
    
<?php
    include 'components/footer.php';
?>