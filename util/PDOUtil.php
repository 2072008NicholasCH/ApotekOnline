<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

class PDOUtil{
    public static function createConnection(){
        $conn = new PDO('mysql:host=localhost:3306;dbname=apotekonline', 'root', '');
        $conn->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}