<?php
session_start;
ini_set('pcre.backtrack_limit', 1024*1024); // (см. ниже)
$new_info = file("data/data.txt");
echo $new_info[0];

$DATA['user'] = sessionUser();
$DATA['email'] = sessionEmail();
$DATA['captcha'] = generateCaptcha();




require_once 'tpl/template_master.php'; // подключаем файл с шаблонизатором

$tpl = 'tpl/form.html'; // путь к шаблону

$html = websun_parse_template_path($DATA, $tpl); // запуск шаблонизатора

echo $html; // получили обработанный шаблон, отдаем клиенту результат
