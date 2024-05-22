<?php

session_start();
include_once ('../dao/UserDao.php');

$userDao = UserDao::getInstance();

$user = $_POST['user'];
$password = md5($_POST['password']);

//concluir condição de login

$result = $userDao;

if ($result) {
    $_SESSION['admin'] = $user;
    header('location: ../view/index.php');
} else {
    $_SESSION['error'] = 'usuário ou senha inválidos!';

    header('location: ../view/login.php');
}
