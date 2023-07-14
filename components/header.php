<?php 
    include 'session/session_start.php';
    include 'pdo-connect/categories.php';
    include 'functions/intId.php';
    include 'pdo-connect/products.php';
    $cartCntItems = count($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="static/script/jquery-3.6.4.js"></script>
    <title><?php echo $header?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="static/styles/style.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-brand">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/about.php">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts.php">Контакты</a>
                </li>
            </ul>
            </div>
            <?php
                if (!empty($_SESSION['user'])){
            ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <?=$_SESSION['user']['login']?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                        <?php 
                            if ($_SESSION['user']['role'] == 'admin'){
                            ?>
                                <li><a class="dropdown-item" href="orders-page.php">Страница заказов</a></li>
                            <?php
                            }
                            if ($_SESSION['user']['role'] == 'admin'){
                            ?>
                                <li><a class="dropdown-item" href="add-products-page.php">Добавить товар/категорию</a></li>
                            <?php
                            }
                            ?>
                        <li><a class="dropdown-item" href="#">Профиль</a></li>
                        <li><a class="dropdown-item" href="index.php?log_out=true">Выйти</a></li>
                    </ul>
                </div>
            <?php
                } else {
                    if (!$login){
                        ?> 
                            <a href="login.php" class="btn btn-success">Войти</a>
                        <?php
                    }
                }
            ?>
        </div>
    </nav>
<div class="container">
    