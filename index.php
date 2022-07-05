<?php
    spl_autoload_register(function($classname){
        require_once __DIR__."/src/".$classname.'.php';
    });

    $route = $_GET['route'] ?? '';
    $routes = include __DIR__."/src/routes.php";
    //var_dump($routes);

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction){
        preg_match($pattern, $route, $matches);
        if (!empty($matches)){
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound){
        echo 'Page not found!';
        return;
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];
    $controller = new $controllerName();
    $controller -> $actionName(...$matches);

    echo '<br />';

    


?>