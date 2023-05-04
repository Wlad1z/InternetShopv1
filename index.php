<?php

    include 'components/header.php';
    
    include 'models/categories.php';

    include 'models/products.php';
  
   
?>

<div class="header">
    <img src="static/img/logo.jpg" alt="">
    <h2>Копейки</h2>
</div>

<div class="catalog">
    <? foreach ($categories as $categorie):?>
        <a href="categories-page.php?pageCat=<?=$categorie['id']?>"> <?= $categorie['name']?></a><br>
        <? if (isset($categorie['children']))
        foreach ($categorie['children'] as $child):?>
            --<a href="categories-page.php?page=<?=$child['id']?>"> <?= $child['name']?></a><br>
        <?endforeach?>
    <?endforeach?>
</div>

<div class="catalog">
    <? foreach ($products as $product):?>
        <div class="card mb-3" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>">
            <img src="<?=$product['image']?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?=$product['name']?></h5>
                <p class="card-text"><?=$product['price']?> руб.</p>
                <p class="card-text"><small class="text-body-secondary"><?=$product['small_description']?></small></p>
                <button class="btn btn-success order">Заказать</button>
                <a href="product-page.php?product=<?=$product['id']?>" class="btn btn-success">Подробнее</a>
            </div>
        </div>
    <?endforeach?>
</div>


<?php
    include 'components/footer.php';
?>