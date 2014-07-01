<?php
session_start();
//include ("../func/functions.php");
include ("../../classes/Form.php");
include ("../../classes/Submit.php");
$newMessage = new Submit($_POST[user],$_POST[email],$_POST[message],$_POST[captcha]);
echo $newMessage->validateAll();
echo $newMessage->getNewInfo();



/*/* принимаем данные пришедшие посредством ajax
$arr[email] = htmlspecialchars(trim($_POST[email]));
$arr[user] = htmlspecialchars(trim($_POST[user]));
$arr[captcha] = htmlspecialchars(trim($_POST[captcha]));
$arr[message] = htmlspecialchars(trim($_POST[message]));

if (validateUser($arr[user]) and validateEmail($arr[email]) and validateMessage($arr[message]) and validateCaptcha($arr[captcha])) {
    $info = json_encode(array('user' => "$arr[user]", 'email' => "$arr[email]", 'message' => "$arr[message]")) . "\n";

    file_put_contents("../../data/data.txt", $info, FILE_APPEND);
    $newInfo = file("../../data/data.txt");
    $i = count($newInfo);

    echo '{"status":1, "message":' . $newInfo[$i - 1] . '}';

// информация возвращаемая сервером
} else {
    if (!validateUser($arr[user])) {
        $errors[user] = "Введите правильное имя";
    }
    if (!validateEmail($arr[email])) {
        $errors[email] = "Введите правильную почту";
    }
    if (!validateMessage($arr[message])) {
        $errors[message] = "Неккоректное сообщение";
    }
    if (!validateCaptcha($arr[captcha])) {
        $errors[captcha] = generateCaptcha();
    }

    $arr = $errors;
    /* Вывод сообщений об ошибке 
    echo '{"status":0, "errors":' . json_encode($arr) . '}';
}*/