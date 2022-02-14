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

        echo "Test: $username mit PW: $pw ";
        //Db Anfrage
        //$erg = $this->db->query("SELECT * FROM user");
        //print_r($erg);

        $user = $this->db->selectUser($username);
        //echo $user;

        var_dump($user);

        //password_verify

        //Fallunterscheidung, ob PW richtig oder falsch
        //Im Fehlerfall LoginForm nochmals anzeigen - mit Fehlermeldung
        //Im Erfolgsfall Seite xy anzeigen
        //Hinweis: Zum überschreiben der View:
        $this->view->setDoMethodName("showLogin");
    }


}