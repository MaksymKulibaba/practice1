<?php

/**
 * Created by PhpStorm.
 * User: artem
 * Date: 18.05.17
 * Time: 19:30
 */

require_once('FormAbstract.php');
require_once('Connection.php');


class CallbackForm extends FormAbstract
{
    public $name;
    public $phone;

    public function __construct(string $name, string $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    public function validate(): bool
    {
        if (empty($this->name) || strlen($this->name) > 20 || strlen($this->name) < 2) {
            return false;
        }
        if (empty($this->phone) || strlen($this->phone) < 7 || strlen($this->phone) > 15) {
            return false;
        }

        return true;
    }

    public function send()
    {
        echo 'Name: ' . $this->name;
        echo '<br>';
        echo 'Phone: ' . $this->phone;
        $dbh = Connection::getConnection();
//        var_dump($dbh);
//        $dbh = new PDO('mysql:host=localhost;dbname=backup', 'root', '');
        $stmt = $dbh->prepare("INSERT INTO requests (name, number) VALUES ('$this->name','$this->phone')");
        $stmt->execute();

    }
}