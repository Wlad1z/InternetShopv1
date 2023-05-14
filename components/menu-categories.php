<div class="menu-categorie">
    <h5>Категории</h5>
    <div >
        <? foreach ($categories as $category):?>
            <a class="link-category" href="categories-page.php?pageCat=<?=intId($category['id'])?>"> <?= $category['name']?></a><br>
            <? if (isset($category['children']))
            foreach ($category['children'] as $child):?>
                <a class="link-pod-category" href="categories-page.php?page=<?=intId($child['id'])?>"> <?= $child['name']?></a><br>
            <?endforeach?>
        <?endforeach?>
        <a class="menuCaption" class="link-category" href="/cart.php" >
            
                <h5>Заказ</h5> 
                
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
             
        </a>
              
    </div>
</div>