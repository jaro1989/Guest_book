<?php

$formInfo->getData();
$DATA['message'] = $formInfo->data;

require_once 'tpl/template_master.php'; // подключаем файл с шаблонизатором

$tpl = 'tpl/message.html'; // путь к шаблону

$html = websun_parse_template_path($DATA, $tpl); // запуск шаблонизатора

echo $html; // получили обработанный шаблон, отдаем клиенту результат
