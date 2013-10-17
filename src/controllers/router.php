<?php

$request = $_SERVER['QUERY_STRING'];

var_dump($request);
// TODO: sanitarize and process request

$target = APPSRC . DS.'controllers'.DS . $page . '.php';

if(file_exists($target))
{
    include_once($target);
    
    $class = $page . 'Controller';

    if(!class_exists($class))
    {
        exit('Class does not exist!');
    }
    
    $controller = new $class;
    $controller->main($getVars);
}
else
{
    exit('Page does not exist!');
}
