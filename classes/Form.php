<?php

Class Form {

    public $user = "Anounimus";
    public $email = "Введите E-MAIL";
    protected $dataDir = "data/data.txt";
    protected $captcha = "";
    protected $message = "";
    public $data;
    public $picture;
    protected $answer;
   /**
    * 
    * @param string $sessionName
    * @param string $sessionEmail
    */
    public function __construct($sessionName = "Anounimus", $sessionEmail = "Введите E-MAIL") {

        $this->user = $sessionName;
        $this->email = $sessionEmail;

        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $this->user;
        }
        if (!isset($_SESSION["email"])) {
            $_SESSION["email"] = $this->email;
        }
        
    }
    /**
     *  Получение сообщений из базы данных
     */
    public function getData() {
        $data = file($this->dataDir);
        foreach ($data as $value) {
            $this->data[] = json_decode($value, true);
        }
    }
    /**
     * 
     * @return boolean
     * Валидация Имени пользователя
     */
    protected function validateUser() {
        if (!preg_match("~^(\w{3,})+$~i", $this->user)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    /**
     * 
     * @return boolean
     * Валидация почтового адреса
     */
    protected function validateEmail() {
        if (!preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $this->email)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    /**
     * 
     * @return boolean
     * генерация капчи
     */
    public function generateCaptcha() {
        $a = rand(1, 9);
        $b = rand(1, 9);

        $this->picture = "$a + $b =";
        $this->answer = $a + $b;
        $_SESSION['answer'] = $this->answer;
    }
    /**
     * 
     * @return boolean
     * Проверка на правильность ответа капчи
     */
    public function validateCaptcha() {
        if ($this->captcha != $_SESSION['answer']) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    /**
     * 
     * @return boolean
     * Валидация текста сообщения
     */
    protected function validateMessage() {
        if (strlen($this->message) < 50 or strlen($this->message) > 800) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
