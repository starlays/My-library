<?php
/**
 * This controller routes all incoming requests to the appropriate controller
 */
$getVars = array();
$request = $_SERVER['QUERY_STRING'];
// TODO: sanitarize and process request
$parsed_query = explode('&', $request);
// the first element is the page
$page = array_shift($parsed_query);
//Automatically includes files containing classes that are called
spl_autoload_register('loadClass');

function loadClass($model) {
        set_include_path(APPSRC.'models'.DS);
        spl_autoload(strtolower($model));
}

// access the coresponding controller for the required page
$target = APPSRC .'controllers'.DS . $page . '.php';

foreach($parsed_query as $vars) {
    //split GET vars along '=' symbol to separate variable, values
    list($variable , $value) = split('=' , $argument);
    $getVars[$variable] = $value;
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
