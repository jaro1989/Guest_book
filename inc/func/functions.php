<?php
session_start;
function sessionUser($sessionName = "Новый писатель"){
	if(!isset($_SESSION['user'])){
		$_SESSION['user'] = $sessionName;
	}
	return $sessionName;
}

function sessionEmail($sessionEmail = "Введите e-mail"){
	if(isset($_SESSION["email"])){
		$_SESSION["email"] = $sessionEmail;
	}
	return $sessionEmail;
}
function generateCaptcha(){
	$a = rand(1,9);
	$b = rand(1,9);
	
	$i = rand(0,2);
	$picture = "$a + $b =";
	$answer = $a + $b;
	$_SESSION['answer'] = $answer;
	
	return $picture;
}




