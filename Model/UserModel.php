<?php


namespace WEP\Model;

use Exception;

class UserModel extends Database
{
    public function selectUser($username)
    {
        $sql = "SELECT * FROM user WHERE username = ?";

        $pdo = $this->linkDB();

        try
        {
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($username));
    
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            echo "Error caught: " . $e->getMessage();
        }
    }

    public function getVereine()
    {
        //von timothy görzen
        $sql = "SELECT * FROM sportingGroup";

        $pdo = $this->linkDB();

        try
        {
            $sth = $pdo->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            echo "Error caught: " . $e->getMessage();
        }
    }

    public function getUser()
    {
        //von timothy görzen
        $sql = "SELECT * FROM user";

        $pdo = $this->linkDB();

        try
        {
            $sth = $pdo->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            echo "Error caught: " . $e->getMessage();
        }
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

    public function addUserToGroup(string $userid, string $groupid)
    {
        $created = date("Y-m-d H:i:s");
        $pdo = $this->linkDB();

        try {

            $sth = $pdo->prepare("INSERT INTO userInGroup VALUES ('$userid', '$groupid', '$created')");
            $sth->execute();
        } 
        catch(Exception $e)
        {
            echo "Error caught: " . $e->getMessage();
        }
    }
}