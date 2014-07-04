<?php

ini_set('pcre.backtrack_limit', 1024 * 1024);
//Создание объектов
$formInfo = new Form();
if (isset($_GET['page']) && isset($_GET['mesNum'])) {
    $pagination = new Paginator($_GET['page'], $_GET['mesNum']);
} else {
    if (isset($_GET['mesNum'])) {
        $pagination = new Paginator(1, $_GET['mesNum']);
    } else {
        $pagination = new Paginator($_GET['page']);
    }
}

//Получение свойств объектов
$formInfo->generateCaptcha();
$pagination->makePaginator();
$pagination->getMessages();
$pagination->getCounter();

//Присвоение свойств объектов соответствующим шаблонам
$DATA['title'] = 'Гостевая книга ';
$DATA['user'] = $formInfo->user;
$DATA['email'] = $formInfo->email;
$DATA['captcha'] = $formInfo->picture;
$DATA['message'] = $pagination->htmlMessages;
$DATA['paginator'] = $pagination->htmlPaginator;
$DATA['counter'] = $pagination->htmlCounter;

require_once 'tpl/template_master.php'; // подключаем файл с шаблонизатором

$tpl = 'tpl/tpl.html'; // путь к шаблону

$html = websun_parse_template_path($DATA, $tpl); // запуск шаблонизатора

echo $html;





