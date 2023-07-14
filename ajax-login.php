<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    $requestData = $_POST;

    $errors = array();

    if (!isset($requestData['login']) || empty($requestData['login']) || !isset($requestData['password']) || empty($requestData['password'])) {
        $errors[] = 'Укажите логин и пароль';
    }

    $response = array();

    if ($errors) {
        $response['errors'] = $errors;
    } else {

        spl_autoload_register(function ($class) {
            include 'classes/' . $class . '.php';
        });

        $PDO = PdoConnect::getInstance();

        $stmt = $PDO->PDO->prepare("SELECT * FROM `users` WHERE `login` = :login AND `password` = :password");
        $stmt->bindParam(':login', $requestData['login']);
        $stmt->bindParam(':password', $requestData['password']);
        $stmt->execute();

        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userInfo) {
            session_start();
            $_SESSION['user']['login'] = $userInfo['login'];
            $_SESSION['user']['role'] = $userInfo['role'];
            $_SESSION['user']['fio'] = $userInfo['fio'];
            $_SESSION['user']['phone'] = $userInfo['phone'];
            $_SESSION['user']['email'] = $userInfo['email'];

            $response['res'] = true; // Авторизация успешна
        } else {
            $response['errors'] = array('Неправильный логин или пароль');
        }
    }

    echo json_encode($response);
}

?>