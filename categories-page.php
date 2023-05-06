<?php

    include 'components/header.php';

    include 'components/menu-categories.php';

    $empty=true;
?>
<div class=catalog>
    <?php
    if ($_GET['pageCat']) {
        $_GET['pageCat'] = intval($_GET['pageCat']);
        foreach ($categories as $category):
            if ($category['id']==$_GET['pageCat']) {
                ?>
                <h1>
                    <?=$category['name']?>
                </h1>
                <?php
                foreach ($category['children'] as $child):?>
                    <h2><a href="categories-page.php?page=<?=intId($child['id'])?>"> <?= $child['name']?></a></h2> 
                <?php
                endforeach;
            }
        endforeach;
    }
    if ($_GET['page']) {
        $_GET['page'] = intval($_GET['page']);
        foreach ($categories as $category):
            foreach ($category['children'] as $child):
                if ($child['id']==$_GET['page']) {
                    ?> 
                        <h1><?= $category['name']?></h1>
                        <h2><?= $child['name']?></h2>
                    <?php
                }
            endforeach;
        endforeach;
        foreach ($products as $product):
            if ($product['category_id']==$_GET['page']) {
                $empty= false;
                ?>
                <div class="card mb-3" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>">
                    <img src="<?=$product['image']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['name']?></h5>
                        <p class="card-text"><?=$product['price']?> руб.</p>
                        <p class="card-text"><small class="text-body-secondary"><?=$product['description']?></small></p>
                        <button class="btn btn-success order">Заказать</button>
                        <a href="product-page.php?product=<?=intId($product['id'])?>" class="btn btn-success">Подробнее</a>
                    </div>
                </div>
                <?php 
            }
        endforeach;
        if ($empty){
            ?> 
            <h2>Машин нет</h2>
            <?php
        }
    };
    
    ?>
</div>


<?php
    include 'components/footer.php'
?>