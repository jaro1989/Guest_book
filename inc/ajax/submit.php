<?php
//include ("../func/functions.php");
session_start;

function validateUser($user){
	if(strlen($user) < 5 or strlen($user) > 50){
		return FALSE;
	}	
	else{
		return TRUE;	
	}
}
function validateEmail($email){
	if(!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $email)){
		return FALSE;
	}
	else{
		return TRUE;	
	}
}
function validateCaptcha($captcha){
	if($captcha != $_SESSION['answer']){
		return FALSE;	
	}
	else{
		return TRUE;	
	}
}
function validateMessage($message){
	if(strlen($message) < 50 or strlen($message) > 800){
		return FALSE;	
	}
	else{
		return TRUE;	
	}
}

// принимаем данные пришедшие посредством ajax
$arr[email] = htmlspecialchars($_POST[email]);
$arr[user] = htmlspecialchars($_POST[user]);
$arr[captcha] = htmlspecialchars($_POST[captcha]);
$arr[message] = htmlspecialchars($_POST[message]);

if(validateUser($arr[user]) and  validateEmail($arr[email]) and validateMessage($arr[message]))
{
$info = json_encode(array('user'=>"$arr[user]",'email'=>"$arr[email]",'message'=>"$arr[message]"))."\n";

file_put_contents("../../data/data.txt", $info, FILE_APPEND);
$new_info = file("../../data/data.txt");
$i = count($new_info);
echo '{"status":1,"message":'.$new_info[$i-1].'}';

// информация возвращаемая сервером
}
else
{

$errors[email] = validateMessage($arr[message]);
$arr = $errors;
/* Вывод сообщений об ошибке */
echo '{"status":0,"errors":'.json_encode($arr).'}';
}

