<?php

ini_set('pcre.backtrack_limit', 1024 * 1024); // (см. ниже)

$DATA['title'] = 'Гостевая книга ';

require_once 'tpl/template_master.php'; // подключаем файл с шаблонизатором

$tpl = 'tpl/head.html'; // путь к шаблону

$html = websun_parse_template_path($DATA, $tpl); // запуск шаблонизатора

echo $html; // получили обработанный шаблон, отдаем клиенту результат