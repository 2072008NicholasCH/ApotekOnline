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
        $query = 'SELECT * FROM user WHERE email = ? AND password = MD5(?)';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $userEmail);
        $stmt->bindParam(2, $userPassword);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt->fetchObject('User');
    }

    public function userSignUp(User $user)
    {
        $link = PDOUtil::createConnection();
        $query = 'INSERT INTO user(email, password, first_name, last_name, phone, role)
        values(?,MD5(?),?,?,?,?)';
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getEmail());
        $stmt->bindValue(2, $user->getPassword());
        $stmt->bindValue(3, $user->getFirstName());
        $stmt->bindValue(4, $user->getLastName());
        $stmt->bindValue(5, $user->getPhone());
        $stmt->bindValue(6, $user->getRole());
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        $link = null;
        return $result;
    }

    public function checkEmail($userEmail)
    {
        $link = PDOUtil::createConnection();
        $query = 'SELECT * FROM user WHERE email = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $userEmail);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $exists = $stmt->fetchObject('User');
        if (!$exists) {
            $result = 0;
        } else {
            $result = 1;
        }
        return $result;
    }
}
