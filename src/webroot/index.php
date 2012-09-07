<?php
//define app root
define('__APPROOT__', dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
//define root
define('__ROOT__', dirname(__FILE__).DIRECTORY_SEPARATOR);
//base app functions file
$base_fns_file  = __APPROOT__.'functions'.DIRECTORY_SEPARATOR.'base'
                                        .DIRECTORY_SEPARATOR.'functions.php';
//modules holder
$pages_fl = __ROOT__.'module_holder.php';
//layout file used for VL
$tpl_flname = __ROOT__.'layout.php';

// errors holder
$errors = array();
//base error constants
const ERR_BASEFN = 10;

// TODO: Dublicated code, write a function{
if(file_exists($base_fns_file) && is_readable($base_fns_file)) {
    require_once ($base_fns_file);
}
else {
    echo sprintf('Error: %d', ERR_BASEFN);
    exit();
}

if(file_exists($pages_fl) && is_readable($pages_fl)) {
    $modules = require_once ($pages_fl);
}
else {
    echo sprintf('Error: %d', ERR_BASEFN);
    exit();
}
// }

if(isset($_GET['page'])) {
    $required_page = htmlspecialchars($_GET['page']);

    if(isset($modules[$required_page])) {
        $page = $required_page;
    }
    else {
        $page = 'home';
    }
}
else {
    $page = 'home';
}


//variable holding all the vars that will go from BL to VL trough render
//function
$tpl_vars = compact('modules', 'page');

$render = render($tpl_flname, $tpl_vars);

switch($render) {
    case RENDER_ERFLIS:
        echo sprintf('Error: %d', RENDER_ERFLIS);
        break;
    case RENDER_ERFLRD:
        echo sprintf('Error: %d', RENDER_ERFLRD);
        break;
    case RENDER_EPYVAR:
        echo sprintf('Error: %d', RENDER_EPYVAR);
        break;
}
