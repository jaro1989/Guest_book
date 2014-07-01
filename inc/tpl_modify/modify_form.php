<?php
$formInfo = new Form();
$DATA['user'] = $formInfo->user;
$DATA['email'] = $formInfo->email;
$formInfo->generateCaptcha();
$DATA['captcha'] = $formInfo->picture;

require_once 'tpl/template_master.php'; // подключаем файл с шаблонизатором

$tpl = 'tpl/form.html'; // путь к шаблону

$html = websun_parse_template_path($DATA, $tpl); // запуск шаблонизатора

echo $html; // получили обработанный шаблон, отдаем клиенту результат
