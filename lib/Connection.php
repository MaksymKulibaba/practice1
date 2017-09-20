<?php
/**
 * Created by PhpStorm.
 * User: Kulibacks
 * Date: 19.09.2017
 * Time: 22:07
 */

class Connection
{
    protected static $dbh;

    private static $login = 'root';
    private static $pass = 'root';
    private static $host = 'localhost';

    public static function getConnection()
    {
        if (null === self::$dbh) {
            self::$dbh = new PDO('mysql:host=localhost;dbname=backup', 'root', '');
        }

        return self::$dbh;
    }
}
