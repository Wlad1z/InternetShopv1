<div class="catalog">
    <? foreach ($categories as $category):?>
        <a href="categories-page.php?pageCat=<?=intId($category['id'])?>"> <?= $category['name']?></a><br>
        <? if (isset($category['children']))
        foreach ($category['children'] as $child):?>
            --<a href="categories-page.php?page=<?=intId($child['id'])?>"> <?= $child['name']?></a><br>
        <?endforeach?>
    <?endforeach?>
    <div class="menuCaption">Корзина</div>
    <a href="/cart.php" title="Перейти в корзину">В корзине</a>
    <span id="cartCntItems">
        <?php
            if ($cartCntItems > 0){
                echo $cartCntItems;
            }
            else{
            ?>Пусто<?php
            }
        ?>
    </span>          
</div>