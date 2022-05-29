<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
class PDOUtil
{
    public static function createConnection()
    {

        $conn = new PDO('mysql:host=localhost;dbname=apotekonline', 'root', '');
        $conn->setAttribute(attribute: PDO::ATTR_AUTOCOMMIT, value: false);
        $conn->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
