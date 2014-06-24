<?php
session_start;
// принимаем данные пришедшие посредством ajax
$arr[email] = $_POST[email];
$arr[user] = $_POST[user];
$arr[captcha] = $_POST[captcha];

if (preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $arr[email]) and $_SESSION['answer'] == $arr[captcha]) {
    echo json_encode(array(''));
// информация возвращаемая сервером
} else {
    if(!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $arr[email])){
         $errors[email] = 'Пожалуйста, введите email.';
    }
    if($_SESSION['answer'] !== $arr[captcha]){
         $errors[captcha] = $_SESSION['answer'];
    }
   
    $arr = $errors;
    /* Вывод сообщений об ошибке */
    echo '{"status":0,"errors":' . json_encode($arr) . '}';
}
