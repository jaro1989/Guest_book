<?php

Class Submit extends Form {

    private $info = "";

    public function __construct($user, $email, $message, $captcha) {
        $this->user = htmlspecialchars(trim($user));
        $this->email = htmlspecialchars(trim($email));
        $this->message = htmlspecialchars(trim($message));
        $this->captcha = htmlspecialchars(trim($captcha));
    }

    public function validateAll() {
        if (parent::validateUser() and
                parent::validateEmail() and
                parent::validateCaptcha() and
                parent::validateMessage()) {
            $this->info = array("user" => $this->user, "email" => $this->email, "message" => $this->message);
            file_put_contents("../../" . $this->dataDir, $this->info, FILE_APPEND);
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
            return '{"status":0, "errors":' . json_encode($errors) . '}';
        }
    }

    public function getNewInfo() {
        if ($this->info != "") {
            $ajaxContent = file("../../" . $this->dataDir);
            $i = count($ajaxContent);
            return '{"status":1, "message":' . $ajaxContent[$i - 1] . '}';
        } else {
            return '{"status":0, "message":"No DATA"}';
        }
    }

}
