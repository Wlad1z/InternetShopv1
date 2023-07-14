<?php
$login = true;
$header = "Авторизация";
include 'components/header.php';

if (!$_GET['registration']){
?>

<div class = 'login_form'>
    <h1><?=$header?></h1>
    <div class="errors"></div>
    <input type="text" name="login" class="form-control" placeholder="Ваш логин">
    <input type="password" name="password" class="form-control" placeholder="Ваш пароль">
    <div class="text-center">
        <button class="btn btn-success login">Войти</button>
        <h5>Нет аккаунта?</h5>
        <a class="btn btn-light" href="login.php?registration=true">Зарегистрироваться</a>
    </div>
</div>

<?php
}
if ($_GET['registration']){
    ?>
    
    
    <div class = 'login_form'>
        <h1>Зарегестрироваться</h1>
        <div class="errors"></div>
        <input type="text" name="fio" class="form-control" placeholder="Ваше имя">
        <input type="phone" name="phone" class="form-control" placeholder="Ваш телефон">
        <input type="email"name="email" class="form-control" placeholder="Ваша почта"> 
        <input type="text" name="login" class="form-control" placeholder="Ваш логин">
        <input type="password" name="password" class="form-control" placeholder="Ваш пароль">
        <div class="text-center">
            <button class="btn btn-success registration">Зарегестрироваться</button>
        </div>
    </div>
    <?php
    } 


include 'components/footer.php'
?>