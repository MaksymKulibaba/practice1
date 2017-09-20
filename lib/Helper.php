<?php
/**
 * Created by PhpStorm.
 * User: Kulibacks
 * Date: 19.09.2017
 * Time: 21:15
 */

class Helper
{
    public static function getPostParam(string $varName)
    {
        return trim($_POST[$varName]) ?? trim($_POST[$varName]);
    }
}