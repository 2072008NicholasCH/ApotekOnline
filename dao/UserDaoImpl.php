<?php
/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */
class UserDaoImpl
{
    public function userLogin($userEmail, $userPassword)
    {
        $link = PDOUtil::createConnection();
        $query = 'SELECT name, email, role FROM user_lab WHERE email = ? AND password = MD5(?)';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $userEmail);
        $stmt->bindParam(2, $userPassword);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetchObject('User');
    }
}
