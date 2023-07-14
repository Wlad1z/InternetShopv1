<?php
    $header = "Копейки";
    include 'components/header.php';

    if($_GET['clear_cart']){
        $_SESSION['cart']= array();
        header('Location: '.$_SERVER['PHP_SELF']);
        $_GET['clear_cart']= false; 
    }
    if($_GET['log_out']){
        $_SESSION['user']= array();
        $_SESSION['cart']= array();
        header('Location: '.$_SERVER['PHP_SELF']);
    }
   
    $formatters = [
        0 => function ($city) {
            return strtoupper($city);
        },
        1 => function ($city) {
            return implode('', array_reverse(str_split($city)));
        },
        2 => function ($city) {
            return strtolower($city);
        },
        3 => function ($city) {
            return str_replace(' ', '_', ucwords($city));
        },
    ];
    
    $formatters = [
        0 => function ($city) {
            return strtoupper($city);
        },
        1 => function ($city) {
            return implode('', array_reverse(str_split($city)));
        },
        2 => function ($city) {
            return strtolower($city);
        },
        3 => function ($city) {
            return str_replace(' ', '_',($city));
        },
    ];
    
    $cities = [
        [
            'title' => 'Moscow city',
            'format' => 0,
        ], [
            'title' => 'Ryazan city',
            'format' => 1,
        ], [
            'title' => 'Tyumen city',
            'format' => 2,
        ], [
            'title' => 'Krasnodar city',
            'format' => 3,
        ],
    ];
    
    foreach ($cities as $city) {
        foreach ($formatters as $value => $key){
            if ($city['format']==$value){
                echo $key($city['title'])."<br>";
            }
        }
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
            <div class="card" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>" data-summa="<?=$product['price']?>" data-quantity="1">
                <a href="product-page.php?product=<?=intId($product['id'])?>"><img src="static/img/<?=$product['image']?>" class="card-img-top card-img" alt="..."></a>
                <div class="card-body">
                <a class="link-category" href="product-page.php?product=<?=intId($product['id'])?>"><h5 class="card-title"><?=$product['name']?></h5></a>
                    <p class="card-text"><?=number_format($product['price'], 0, ' ', ' ')?> руб.</p>
                    <p class="card-text small-description"><small class="text-body-secondary"><?=$product['small_description']?></small></p>
                </div>
                <div class="card-footer">
                    <div class="product-buttons product-buttons-bottom">
                        <button class="btn btn-success order">Купить</button>
                        <div class="count_product" id="count<?=$product['id']?>">
                        <?php
                            $count = 0;
                            foreach ($_SESSION['cart'] as $car):
                                if ($car['id'] == $product['id']){
                                    $count+=1;
                                }
                            endforeach;
                            if ($count == 0){ ?>
                                <a href="#" id="" onclick="return false" class="btn btn-success addCart" data-id="<?=$product['id']?>">В заказ</a>
                            <?php 
                            } else {
                                ?>
                                <button href="#" id="delCart<?=$product['id']?>" class="btn btn-success delCart" data-id="<?=$product['id']?>">-</button>
                                <h5 id="inCart<?=$product['id']?>"><span><?=$count?></h5>
                                <button href="#" id="addCart<?=$product['id']?>" onclick="return false" class="btn btn-success addCart" data-id="<?=$product['id']?>">+</button>
                            <?php 
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?endforeach?>
    </div>
</div>

<?php
    include 'components/footer.php';
?>