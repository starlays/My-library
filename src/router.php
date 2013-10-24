<?php
/**
 * This controller routes all incoming requests to the appropriate controller
 */
$getVars = array();
$request = $_SERVER['QUERY_STRING'];

var_dump('Request: ',$request);
// TODO: sanitarize and process request
$parsed_query = explode('&', $request);
// the first element is the page
$page = array_shift($parsed_query);
$target = APPSRC . DS.'controllers'.DS . $page . '.php';

foreach($parsed_query as $vars) {
    
}

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
