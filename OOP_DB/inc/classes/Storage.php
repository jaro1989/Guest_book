<?php

/**
 * Класс Storage выполняет работу с сохранением и выводом данных
 * Реализует интерфейса Data.
 * Принимает в себя int параметр: 1-работа с MySQL, 2 - работа с файлом
 * 
 */
class Storage implements Data {

    public $dsn = 'mysql:dbname=messanger;host=127.0.0.1';
    public $user = 'root';
    public $password = '';
    public $dataDir = "data/data.txt"; //Дериктория файла с данными
    private $type; //Тип хранения данных (1 - MySQL, 2 - FILE.txt)
    /**
     * 
     * @param int $type - тип хранения данных (1 - MySQL, 2 - FILE.txt)
     */
    public function __construct($type) {

        $this->type = $type;
        $this->connect();
    }
    
    private function connect() {

        if ($this->type == 1) {

            try {
                $this->dbh = new PDO($this->dsn, $this->user, $this->password);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
    }
    /**
     * 
     * @return array $this->data Получение массива данных
     */
    public function getData() {

        if ($this->type == 1) {
            $query = 'SELECT user,email,message FROM m_messages';
            $sth = $this->dbh->prepare($query);
            $sth->execute();
            $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        if ($this->type == 2) {
            $file = file($this->dataDir);
            foreach ($file as $value) {
                $this->data[] = json_decode($value, true);
            }
        }
        return $this->data;
    }
    /**
     * 
     * @param string $user Имя пользователя
     * @param string $email Почтовый адрес
     * @param string $message Текст сообщение
     * 
     * Заносит данные в базу 
     */
    public function putData($user, $email, $message) {

        if ($this->type == 1) {
            $sth = $this->dbh->prepare('INSERT INTO m_messages (`id` ,`user` ,`email` ,`message`) VALUES (NULL , :user, :email, :message');
            $sth->execute(array(':user' => $user, ':email' => $email, ':message' => $message));
        }
        if ($this->type == 2) {
            $info = json_encode(array("user" => $user, "email" => $email, "message" => $message)) . "\n";
            file_put_contents($this->dataDir, $info, FILE_APPEND);
        }
    }

}
