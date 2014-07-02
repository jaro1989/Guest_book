<?php
session_start();
include ("../../classes/Submit.php");
$newMessage = new Submit($_POST[user],$_POST[email],$_POST[message],$_POST[captcha]);
echo $newMessage->ajaxInfo;
