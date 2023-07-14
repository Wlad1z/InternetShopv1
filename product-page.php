<?php
    include 'components/header.php';
    include 'pdo-connect/gallery-products.php';
    include 'pdo-connect/comments-product.php';
    include 'pdo-connect/products.php';
    foreach ($products as $product):
        if ($product['id']==$_GET['product']){
            $header = $product['name'];
            $productFound = true;
            break;
        }
    endforeach;
    if (!$productFound){
        ?>
                <div class="content ">
                    <h1>Товар не найден.</h1>
                </div>
            </div>
        <?php
        
    }
    
    
?>
<div class="header">
    <h2><?php echo $header?></h2>
</div>
<div class="content ">
    <?php

    include 'components/menu-categories.php';

    foreach ($products as $product):
        if ($product['id']==$_GET['product']){
        ?>
            <div class="card mb-3 product" data-id="<?=$product['id']?>" data-name="<?=$product['name']?>" data-price="<?=$product['price']?>" data-summa="<?=$product['price']?>">
                <img src="static/img/<?=$product['image']?>" class="card-img-top card-img-product" alt="...">
                <div class="card-body">
                    <h4><?=number_format($product['price'], 0, ' ', ' ')?> руб.</h4>
                    <p class="card-text"><?=$product['big_description']?></p>
                    <div class="product-buttons">
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
            
        </div>

        <?php
            if (!empty($gallery)) {
                ?>
                <div class="slider">
                    <?php
                    foreach ($gallery as $item):
                        ?>
                        <div class="slider_item">
                            <img src="<?=$item['way']?><?=$item['product_id']?>/<?=$item['name']?>" alt="">
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class='comments'>
                    <h1>Комментарии</h1>
                    <?php
            }
            if (!empty($_SESSION['user'])){
                ?>
                    <div class="add-comments">
                        <h3>Добавить комментарий</h3>
                        <div class="errors"></div>
                        <div class='form'>
                            <input type="hidden" name="product-id" value="<?=$product['id']?>">
                            <input type="hidden" name="login" value="<?=$_SESSION['user']['login']?>">
                            <input type="text" class="form-control"  placeholder="Комментарий" name="comment_product">
                            <button class="add-comment btn btn-success">Отправить</button>
                        </div>
                        
                    </div>
                <?php
            }
            ?>
                <div class='product-comment'>
                    <?php
                        if (empty($comments))
                            echo'<h3>Комментариев нет.</h3>';
                        else {
                            foreach ($comments as $comment):
                                ?>
                                    <div class = 'comment <?php if($comment['login'] == $_SESSION['user']['login']){echo'my-comment';}?>' >
                                        <div class="login">
                                            <p class = '<?php if($comment['login'] == $_SESSION['user']['login']){echo'my-login';}?>'><?=$comment['login']?></p>
                                            <span><?=$comment['body_comment']?></span>
                                        </div>
                                        <div class="time">
                                            <p><?=$comment['date']?></p>
                                            <span><?=$comment['time']?></span>
                                        </div>
                                    </div>
                                <?php
                            endforeach;
                        }
                    ?>
                </div>
            </div>
            <?php
            
        };

    endforeach;
    
    include 'components/footer.php';
?>
