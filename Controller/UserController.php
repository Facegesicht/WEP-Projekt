<?php


namespace WEP\Controller;

use WEP\Library\View;
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

    public function showProfile()
    {

    }

    public function showMitarbeiterProfil()
    {
        if($this->checkIfLoggedIn())
        {
            $mitglieder = $this->db->getUser();
            $this->view->setVars([
                'mitglieder' => $mitglieder]);
                //echo "WARUM IST PHP SO SHIT";
        }
        else
        {
            $this->view->setDoMethodName("showLogin");
        }
    }

    public function showRegistration()
    {

    }

    public function showLogout()
    {
        $_SESSION["login"] = 0;
    }

    public function showStart() 
    {
        //von timothy görzen
        if($this->checkIfLoggedIn())
        {
            $vereine = $this->db->getVereine();
            $this->view->setVars([
                'vereine' => $vereine]);
        }
        else
        {
            $this->view->setDoMethodName("showLogin");
        }
    }

    public function showUserAddToGroup()
    {
        $this->db->addUserToGroup($_SESSION["id"], $_GET["value"]);
    }

    function checkIfLoggedIn()
    {
        // von timothy görzen
        if ($_SESSION["login"] != 1)
        {
            //include("showLogin.phtml");
            //exit;
            return false;
        }
        else
        {
            return true;
        }
    }

    function checkLogin()
    {
        // von Timothy Görzen

        if(isset($_POST["username"]) && isset($_POST["pw"]))
        {
            $username = $_POST["username"];
            $pw = $_POST["pw"];

            $user = $this->db->selectUser($username);
    
            if($user !== false && password_verify($pw, $user['pw']))
            {
                $this->setSessionVars($user);
                $this->view->setDoMethodName("showStart");
            }
            else
            {
                $this->view->setDoMethodName("showLogin");
            }
        }
    }

    function setSessionVars($user)
    {
        //von timothy görzen
        $_SESSION["login"] = 1;
        $_SESSION["id"] = $user['id'];
        $_SESSION["username"] = $user['username'];
        $_SESSION["firstname"] = $user['firstname'];
        $_SESSION["lastname"] = $user['lastname'];
        $_SESSION["isTrainer"] = $user['isTrainer'];
        $_SESSION["isClerk"] = $user['isClerk'];
    }
}