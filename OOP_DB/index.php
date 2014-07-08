<?php
session_start();
//Подключение классов
include ("inc/classes/Data.php");
include ("inc/classes/Storage.php");
include ("inc/classes/pagination.class.php");
include("inc/classes/PFBC/Form.php");
//Создание объектов и работа с ними
include ("inc/tpl_modify/form_modify.php");
include ("inc/tpl_modify/message_modify.php");
//Вывод шаблона
include ("tpl/tpl.php");

