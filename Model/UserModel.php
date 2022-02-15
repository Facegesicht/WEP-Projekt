<?php


namespace WEP\Model;


class UserModel extends Database
{
    public function selectUser($username)
    {
        $sql = "SELECT * FROM user WHERE username = ?";

        $pdo = $this->linkDB();

        //try catch
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($username));

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function checkPassword($username, $password)
    {
        $sql = "SELECT pw FROM user WHERE $username";

        $pdo = $this->linkDB();

        //try catch
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($username));

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}