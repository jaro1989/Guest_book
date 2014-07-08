<?php	
use PFBC\Form;
use PFBC\Element;
use PFBC\Validation;
if(isset($_POST["form"])) {
	Form::isValid($_POST["form"]);
	$newMessage = new Storage(1);
    	$newMessage->putData($_POST['User'], $_POST['Email'], $_POST['Message']);
	header("Location: " . $_SERVER["PHP_SELF"]);
	exit();	
}
$form = new Form("validation");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery")
));
$form->addElement(new Element\Hidden("form", "validation"));
$form->addElement(new Element\Textbox("User:", "User", array(
	"required" => 1,
	"longDesc" => "The required property provides a shortcut for applying the Required class to the element's
	validation property.  If supported, the HTML5 required attribute will also provide client-side validation."
)));

$form->addElement(new Element\Email("Email:", "Email", array(
	"longDesc" => "The Email element applies the Email validation rule by default.  If supported, HTML5
	validation will also be provided client-side."
)));

$form->addElement(new Element\Textarea("Тект сообщения:", "Message", array(
        "cols" => 50,
        "rows" =>10,
	"longDesc" => "The AlphaNumeric validation class will verify that the element's submitted value contains only letters, 
	numbers, underscores, and/or hyphens."
)));
$form->addElement(new Element\Captcha("Captcha:", array(
	"longDesc" => "The Captcha element applies the Captcha validation, which uses <a href=\"http://www.google.com/recaptcha\">
	reCaptcha's anti-bot service</a> to reduce spam submissions."
)));

$form->addElement(new Element\Button);


