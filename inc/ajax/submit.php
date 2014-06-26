<?php

session_start();

function validateUser($user) {
    if (strlen($user) < 5 or strlen($user) > 50) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function validateEmail($email) {
    if (!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $email)) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function validateCaptcha($captcha) {
    if ($captcha != $_SESSION['answer']) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function validateMessage($message) {
    if (strlen($message) < 50 or strlen($message) > 800) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function generateCaptcha() {
    $a = rand(1, 9);
    $b = rand(1, 9);
    
    $picture = "$a + $b =";
    $answer = $a + $b;
    $_SESSION['answer'] = $answer;

    return $picture;
}

// принимаем данные пришедшие посредством ajax
$arr[email] = htmlspecialchars(trim($_POST[email]));
$arr[user] = htmlspecialchars(trim($_POST[user]));
$arr[captcha] = htmlspecialchars(trim($_POST[captcha]));
$arr[message] = htmlspecialchars(trim($_POST[message]));

if (validateUser($arr[user]) and validateEmail($arr[email]) and validateMessage($arr[message]) and validateCaptcha($arr[captcha])) {
    $info = json_encode(array('user' => "$arr[user]", 'email' => "$arr[email]", 'message' => "$arr[message]")) . "\n";

    file_put_contents("../../data/data.txt", $info, FILE_APPEND);
    $newInfo = file("../../data/data.txt");
    $i = count($newInfo);
    $newCaptcha = generateCaptcha();
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
    /* Вывод сообщений об ошибке */
    echo '{"status":0, "errors":' . json_encode($arr) . '}';
}