<?php

session_start();
header('Content-Type: text/html; charset=utf-8');
include 'connect.php';


$login = $_POST['login'];
$password = $_POST['password'];

$check_user = $connect->query("SELECT * FROM users WHERE login='$login' AND password='$password';");
$check_admin = $connect->query("SELECT * FROM users WHERE login='admin' AND password='111';");
$user = $check_user->fetch(PDO::FETCH_ASSOC);
$count = $check_user->rowCount();
$_SESSION['user_id'] = $user['id'];

if ($login === '') {
    $_SESSION['message'] = 'Логин не может быть пустым!';
    header('Location: ../');
} elseif ($password === '') {
    $_SESSION['message'] = 'Пароль не может быть пустым!';
    header('Location: ../');
} elseif ($count === 0) {
    $_SESSION['message'] = 'Не верный логин или пароль!';
    header('Location: ../');
} elseif ($login === 'admin' && $password === $password) {
    $_SESSION['name'] = $user['name'];
    header('Location: ./base.php');
} else {
    $_SESSION['name'] = $user['name'];
    header('Location: ./profile.php');
}
