<?php

namespace WEP\Controller;

class DefaultController
{
    function testFunction1()
    {
        echo "du wurdest ausgeloggt";
        $_SESSION["login"] = 0;
    }

    function testFunction2()
    {
        if ($_SESSION["login"] != 1)
        {
            echo "du bist nicht eingeloggt";
            //include("showLogin.phtml");
            //exit;
        }
        else
        {
            echo "du bist eingeloggt";
        }
    }
}

