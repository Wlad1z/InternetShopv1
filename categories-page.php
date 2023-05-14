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
                <div class="card mb-3 product" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>">
                    <img src="static/img/<?=$product['image']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['name']?></h5>
                        <p class="card-text"><?=number_format($product['price'], 0, ' ', ' ')?> руб.</p>
                        <p class="card-text"><small class="text-body-secondary"><?=$product['description']?></small></p>
                        <div class="product-buttons">
                            <button class="btn btn-success order">Купить</button>
                            <a href="cart.php?addtocart=<?=$product['id']?>" class="btn btn-success addCart" id="addCart<?=$product['id']?>">В заказ</a>
                            <a href="product-page.php?product=<?=intId($product['id'])?>" class="btn btn-success">Подробнее</a>
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