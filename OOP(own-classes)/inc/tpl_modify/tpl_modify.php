<?php

ini_set('pcre.backtrack_limit', 1024 * 1024);
//Создание объектов
$formInfo = new Form();
if (isset($_GET['page']) && isset($_GET['mesNum'])) {
    $messanger = new Messanger($_GET['page'], $_GET['mesNum']);
} else {
    if (isset($_GET['mesNum'])) {
        $messenger = new Messanger(1, $_GET['mesNum']);
    } else {
        $messenger = new Messanger($_GET['page']);
    }
}

//Получение свойств объектов
$formInfo->generateCaptcha();
$messenger->getPaginator();
$messenger->getMessages();
$messenger->getCounter();

//Присвоение свойств объектов соответствующим шаблонам
$DATA['title'] = 'Гостевая книга ';
$DATA['user'] = $formInfo->user;
$DATA['email'] = $formInfo->email;
$DATA['captcha'] = $formInfo->picture;
$DATA['message'] = $messenger->htmlMessages;
$DATA['paginator'] = $messenger->htmlPaginator;
$DATA['counter'] = $messenger->htmlCounter;

// подключаем файл с шаблонизатором
require_once 'tpl/template_master.php'; 

// путь к шаблону
$tpl = 'tpl/tpl.html'; 

// запуск шаблонизатора
$html = websun_parse_template_path($DATA, $tpl); 

echo $html;





