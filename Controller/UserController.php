<?php


namespace WEP\Controller;

use WEP\Model\UserModel;


class UserController
{
    protected $view;
    private $db;

    public function __construct($view)
    {
        $this->db = new UserModel();
        $this->view = $view;
    }

    public function showLogin()
    {
        $this->checkLogin();
    }

    public function showLogout()
    {
        echo "du wurdest ausgeloggt";
        $_SESSION["login"] = 0;
    }

    function showStart() 
    {
        //von timothy görzen
        $this->checkIfLoggedIn();
    }

    function checkIfLoggedIn()
    {
        // von timothy görzen
        if ($_SESSION["login"] != 1)
        {
            echo "du bist nicht eingeloggt";
            $this->view->setDoMethodName("showLogin");
            //include("showLogin.phtml");
            //exit;
        }
        else
        {
            echo "du bist eingeloggt";
        }
    }

    public function checkLogin()
    {
        // von Timothy Görzen

        /*
        if ($_SESSION["login"] != 1)
        {
            $this->view->setDoMethodName("showLogin");
        }
        else
        {
            return;
        }
        */

        if(isset($_POST["username"]) && isset($_POST["pw"]))
        {
            $username = $_POST["username"];
            $pw = $_POST["pw"];
    
            echo "Test3: $username mit PW: $pw ";

            $user = $this->db->selectUser($username);
    
            if($user !== false && password_verify($pw, $user['pw']))
            {
                var_dump($user);
                $_SESSION["login"] = 1;
                $this->view->setDoMethodName("showStart");
            }
            else
            {
                //new \WEP\Library\ErrorMsg('Email oder Passwort falsch');
                $message = "wrong answer";
                echo "<script type='text/javascript'>alert('$message');</script>";
                $php_errormsg = "Email oder Passwort ungültig";
                //echo "bruder moment, es hat nicht funktioniert";
            }
        }

        //$erg = $this->db->query("SELECT * FROM user");
        //print_r($erg);

        //echo $user;

        //password_verify

        //Fallunterscheidung, ob PW richtig oder falsch
        //Im Fehlerfall LoginForm nochmals anzeigen - mit Fehlermeldung
        //Im Erfolgsfall Seite xy anzeigen
        //Hinweis: Zum überschreiben der View:
    }
}