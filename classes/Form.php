<?php

Class Form {

    public $user = "Anounimus";
    public $email = "Введите E-MAIL";
    private $dataDir = "data/data.txt";
    public $captcha = "";
    public $message = "";
    public $data;
    public $picture;
    private $answer;

    public function __construct($sessionName = "Anounimus", $sessionEmail = "Введите E-MAIL") {

        $this->user = $sessionName;
        $this->email = $sessionEmail;

        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $this->user;
        }
        if (!isset($_SESSION["email"])) {
            $_SESSION["email"] = $this->email;
        }
        return $this->user;
    }

    public function getData() {
        $data = file($this->dataDir);
        foreach ($data as $value) {
            $this->data[] = json_decode($value, true);
        }
    }

    protected function validateUser() {
        if (!preg_match("~^(\w{3,})+$~i", $this->user)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    protected function validateEmail() {
        if (!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $this->email)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function generateCaptcha() {
        $a = rand(1, 9);
        $b = rand(1, 9);

        $this->picture = "$a + $b =";
        $this->answer = $a + $b;
        $_SESSION['answer'] = $this->answer;
    }

    public function validateCaptcha() {
        if ($this->captcha != $_SESSION['answer']) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function validateMessage() {
        if (strlen($this->message) < 50 or strlen($this->message) > 800) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}