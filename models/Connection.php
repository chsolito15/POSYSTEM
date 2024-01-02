<?php

class Connection
{
    public static function connect()
    {

        $conn = new PDO("mysql:host=localhost:3309;dbname=poswebsite", "root", "");

        $conn->exec("set names utf8");

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
