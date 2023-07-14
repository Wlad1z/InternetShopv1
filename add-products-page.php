<?php
    $header = "Добавление товара";
    include 'components/header.php';
    if ($_SESSION['user']['role'] != 'admin'){
        header('Location: index.php');
    }
?>
    <div class="text-center">
        <h1>Добавить</h1>
        <a href="add-products-page.php?add=product" class="btn btn-success mt-1 ">Товар</a>
        <a href="add-products-page.php?add=category" id="add_categories" class="btn btn-success mt-1 ">Категория</a>
        <a href="add-products-page.php?add=children_category" id="add_children_categories" class="btn btn-success mt-1 ">Подкатегория</a>
    </div>

<?php
    if ($_GET['add'] == 'product'){
?>
    <h2>Товар</h2>
    <div class="errors"></div>
    <div>
        <input type="text" class="form-control mt-1" placeholder="Название товара" name="name_product">
        <input type="text" class="form-control mt-1" placeholder="Цена" name="price_product">
        <textarea name="small_description" id="" cols="30" rows="3" class="form-control mt-1" placeholder="Краткое описание" ></textarea>
        <textarea name="big_description" id="" cols="30" rows="5" class="form-control mt-1" placeholder="Подробное описание" ></textarea>
        <select class="form-control mt-1" name="category_id">
            <option value="" >Выберите подкатегорию товара</option>
            <?php
            foreach ($categories as $category):
                foreach ($category['children'] as $child):
                    {
                        ?> 
                            <option value="<?=$child['id']?>"><?=$child['name']?></option>
                        <?php
                    }
                endforeach;
            endforeach;
        ?>
        </select>
        <button id="add_product" class="btn btn-success mt-1 ">Добавить</button>
    </div>
<?php
    }
    if ($_GET['add'] == 'category'){
?>
    <h2>Категория</h2>
    <div class="errors"></div>
    <div>
        <input type="text" class="form-control mt-1" placeholder="Название категории" name="name_category">
        <input type="hidden" value="<?=0?>" name="parent_id">
        <button id="add_category" class="btn btn-success mt-1 ">Добавить</button>
    </div>
<?php
    }
    if ($_GET['add'] == 'children_category'){
?>
    <h2>Подкатегория</h2>
    <div class="errors"></div>
    <div>
        <input type="text" class="form-control mt-1" placeholder="Название подкатегории" name="name_children_category">
        <select class="form-control mt-1" name="parent_id">
            <option value="" >Выберите родительскую категорию товара</option>
            <?php
            foreach ($categories as $category):
                ?> 
                    <option value="<?=$category['id']?>"><?=$category['name']?></option>
                <?php
            endforeach;
        ?>
        </select>
        <button id="add_children_category" class="btn btn-success mt-1 ">Добавить</button>
    </div>
<?php
    }
?>

<?php
    include 'components/footer.php';
?>