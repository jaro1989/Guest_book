<?php

include("Form.php");

Class Submit extends Form {

    public $ajaxInfo = "";
    private $info = "";

    public function __construct($user, $email, $message, $captcha) {
        parent::__construct($user, $email);

        $this->user = htmlspecialchars(trim($user));
        $this->email = htmlspecialchars(trim($email));
        $this->message = htmlspecialchars(trim($message));
        $this->captcha = htmlspecialchars(trim($captcha));
        $this->validateAll();
    }

    private function validateAll() {
        if (parent::validateUser() and
                parent::validateEmail() and
                parent::validateCaptcha() and
                parent::validateMessage()) {
            $this->info = json_encode(array("user" => $this->user, "email" => $this->email, "message" => $this->message)) . "\n";
            file_put_contents("../../" . $this->dataDir, $this->info, FILE_APPEND);
            $this->getNewInfo();
        } else {
            if (!parent::validateUser()) {
                $errors[user] = "Введите правильное имя";
            }
            if (!parent::validateEmail()) {
                $errors[email] = "Введите правильное имя";
            } if (!parent::validateMessage()) {
                $errors[message] = "Введите правильное имя";
            } if (!parent::validateCaptcha()) {
                parent::generateCaptcha();
                $errors[captcha] = $this->picture;
            }
            $this->ajaxInfo = '{"status":0, "errors":' . json_encode($errors) . '}';
        }
    }

    private function getNewInfo() {
        if ($this->info != "") {
            $ajaxContent = file("../../" . $this->dataDir);
            $i = count($ajaxContent);
            $this->ajaxInfo = '{"status":1, "message":' . $ajaxContent[$i - 1] . '}';
        }
    }

}
