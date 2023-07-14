<?php
    $header = "Категории";
    include 'components/header.php';
    $empty=true;
    
?>

<div class="header">
    <img src="static/img/logo.jpg" alt="">
    <h2><?php echo $header?></h2>
</div>
<div class="content">
<?php include 'components/menu-categories.php'; ?>

<div class=categories>
    <?php
    if ($_GET['pageCat']) {
        $_GET['pageCat'] = intval($_GET['pageCat']);
        foreach ($categories as $category):
            if ($category['id']==$_GET['pageCat']) {
                ?>
                <h1 class="ml">
                    <?=$category['name']?>
                </h1>
                <?php
                if(!$category['children']){
                    echo "<h2 class='ml'>Нет подкатегорий</h2>";
                } else {
                    foreach ($category['children'] as $child):
                        ?>
                            <h2 class="ml"><a class="link-category" href="categories-page.php?page=<?=intId($child['id'])?>"> <?= $child['name']?></a></h2> 
                        <?php
                    endforeach;
                }
                
            }
        endforeach;
    }
    if ($_GET['page']) {
        $_GET['page'] = intval($_GET['page']);
        foreach ($categories as $category):
            foreach ($category['children'] as $child):
                
                if ($child['id']==$_GET['page']) {
                    ?> 
                        <h1 class="ml"><?= $category['name']?></h1>
                        <h2 class="ml"><?= $child['name']?></h2>
                    <?php
                }
            endforeach;
        endforeach;
        foreach ($products as $product):
            if ($product['category_id']==$_GET['page']) {
                $empty= false;
                ?>
                    <div class="card" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>" data-summa="<?=$product['price']?>">
                        <a href="product-page.php?product=<?=intId($product['id'])?>"><img src="static/img/<?=$product['image']?>" class="card-img-top card-img" alt="..."></a>
                        <div class="card-body">
                        <a class="link-category" href="product-page.php?product=<?=intId($product['id'])?>"><h5 class="card-title"><?=$product['name']?></h5></a>
                            <p class="card-text"><?=number_format($product['price'], 0, ' ', ' ')?> руб.</p>
                            <p class="card-text"><small class="text-body-secondary"><?=$product['small_description']?></small></p>
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
                                        <a href="#" onclick="return false" class="btn btn-success addCart" data-id="<?=$product['id']?>">В заказ</a>
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
                <?php 
            }
        endforeach;
        if ($empty){
            ?> 
            <h2 class="ml">Машин нет</h2>
            <?php
        }
    };
    
    ?>
</div>
</div>

<?php
    include 'components/footer.php'
?>