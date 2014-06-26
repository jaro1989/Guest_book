<?php
session_start();
function sessionUser($sessionName = "Аноним") {
    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = $sessionName;
    }
    return $sessionName;
}

function sessionEmail($sessionEmail = "Введите e-mail") {
    if (!isset($_SESSION["email"])) {
        $_SESSION["email"] = $sessionEmail;
    }
    return $sessionEmail;
}

function generateCaptcha() {
    $a = rand(1, 9);
    $b = rand(1, 9);

    $i = rand(0, 2);
    $picture = "$a + $b =";
    $answer = $a + $b;
    $_SESSION['answer'] = $answer;

    return $picture;
}
function getData(){
	$newArray2 = array(1=>1);
	$data = file("data/data.txt");
	foreach($data as $key =>$value){
		
		$newArray[] = json_decode($value , true); 
		
	}
	return $newArray;
}