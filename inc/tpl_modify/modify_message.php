<?php

ini_set('pcre.backtrack_limit', 1024 * 1024); // (см. ниже)

$dataGet = getData();
$DATA['message'] = $dataGet;

require_once 'tpl/template_master.php'; // подключаем файл с шаблонизатором

$tpl = 'tpl/message.html'; // путь к шаблону

$html = websun_parse_template_path($DATA, $tpl); // запуск шаблонизатора

echo $html; // получили обработанный шаблон, отдаем клиенту результат
