<?php
session_start();

/**
 * Заносит в сессию имя пользователя
 * @param string $sessionName
 * @return string $sessionName
 */
function sessionUser($sessionName = "Аноним") {
    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = $sessionName;
    }
    return $sessionName;
}

/**
 * Заносит в сессию email
 * @param string $sessionEmail
 * @return string $sessionEmail
 */
function sessionEmail($sessionEmail = "Введите e-mail") {
    if (!isset($_SESSION["email"])) {
        $_SESSION["email"] = $sessionEmail;
    }
    return $sessionEmail;
}

/**
 * Возвращает капчу и заносит в сессию ответ
 * @return string $picture
 */
function generateCaptcha() {
    $a = rand(1, 9);
    $b = rand(1, 9);

    $picture = "$a + $b =";
    $answer = $a + $b;
    $_SESSION['answer'] = $answer;

    return $picture;
}

/**
 * Возвращает массив данных из текстового файла
 * @return array $newArray
 */
function getData() {
    $data = file("data/data.txt");
    foreach ($data as $value) {

        $newArray[] = json_decode($value, true);
    }
    return $newArray;
}

function validateUser($user) {
    if (!preg_match("~^([a-z0-9_\-\.])+$~i", $user)) {
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
