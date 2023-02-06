<?php

use MyProject\Exceptions\DbException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\NotRegisterException;
use MyProject\Views\View;

try{

    spl_autoload_register(function($className){
        require_once __DIR__ . '\..\src\\' . $className . '.php';
    });
    
    
    $route = $_GET['route'] ?? '';
    
    $allRoutes = require __DIR__ . '/../src/routes.php';
    
    $isConfidern = false;


    foreach($allRoutes as $pattern => $controllerNames)
    {
        preg_match($pattern, $route, $matches);
        if(!empty($matches))
        {
            $isConfidern = true;     
            break;   
        }
    }


    if(!$isConfidern)
    {
        throw new NotFoundException('Page is not found');
    }

    unset($matches[0]);

    $controllerNamespase = $controllerNames[0];
    $controllerFuncName = $controllerNames[1];

    $controller = new $controllerNamespase;
    $controller->$controllerFuncName(...$matches);


}catch(DbException $e){
    $view = new View('/../../../templates');
    $view->renderHtml('error/errorException.php', ['exception' => $e->getMessage()], 500);
}catch(notFoundException $e){
    $view = new View('/../../../templates');
    $view->renderHtml('error/errorException.php', ['exception' => $e->getMessage()], 404);
}catch(NotRegisterException $e){
    $view = new View('/../../../templates');
    $view->renderHtml('error/notRegister.php', ['exception' => $e->getMessage()], 404);
}





























