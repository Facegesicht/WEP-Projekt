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

    }

    public function checkLogin()
    {
        $username = $_POST["username"];
        $pw = $_POST["pw"];

        echo "Test3: $username mit PW: $pw ";
        //Db Anfrage
        $user = $this->db->selectUser($username);

        //$result = $user->execute(array('username'=>$username));
        //$erg = $user->fetch();

        if($user !== false && password_verify($pw, $user['pw']))
        {
            var_dump($user);

        }
        else
        {
           $php_errormsg = "Email oder Passwort ungültig";
           echo "bruder moment, es hat nicht funktioniert";
        }

        //$erg = $this->db->query("SELECT * FROM user");
        //print_r($erg);

        //echo $user;

        //password_verify

        //Fallunterscheidung, ob PW richtig oder falsch
        //Im Fehlerfall LoginForm nochmals anzeigen - mit Fehlermeldung
        //Im Erfolgsfall Seite xy anzeigen
        //Hinweis: Zum überschreiben der View:
        $this->view->setDoMethodName("showLogin");
    }


}