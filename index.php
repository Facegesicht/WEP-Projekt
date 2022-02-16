<?php 

session_start();

spl_autoload_register(function ($className) 
{
    if (substr($className, 0, 4) !== 'WEP\\') 
    {
            // not our business
            return;
    }

    $fileName = __DIR__.'/'.str_replace('\\', DIRECTORY_SEPARATOR, substr($className, 4)).'.php';

    if (file_exists($fileName)) 
    {
            include $fileName;
    }
});    
    
    
$controllerName = "";
$doMethodName = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $controllerName = isset($_POST['controller']) && $_POST['controller'] ? $_POST['controller'] : "User";
    $doMethodName = isset($_POST['do']) && $_POST['do'] ? $_POST['do'] : "showLogin";
} 
else 
{
    $controllerName = isset($_GET['controller']) && $_GET['controller'] ? $_GET['controller'] : "User";
    $doMethodName = isset($_GET['do']) && $_GET['do'] ? $_GET['do'] : "showLogin";
}

$controllerClassName = 'WEP\\Controller\\'.ucfirst($controllerName).'Controller';

if (method_exists($controllerClassName, $doMethodName)) 
{
    $view = new \WEP\Library\View(__DIR__.DIRECTORY_SEPARATOR.'Views'
                , ucfirst($controllerName), $doMethodName);
    
    $controller = new $controllerClassName($view);
    $controller->$doMethodName();

    $view->render();

}
else 
{
    new \WEP\Library\ErrorMsg('Page not found: '.$controllerClassName.'::'.$doMethodName); 
}
  
?>