<?php
//define root
define('__ROOT__', dirname(__FILE__).DIRECTORY_SEPARATOR);
//define app root
define('__APPROOT__', dirname(__ROOT__).DIRECTORY_SEPARATOR);
//modules path
define('__MODULES__', __APPROOT__.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR);
//base app functions file
$base_fns_file  = __APPROOT__.'modules'.DIRECTORY_SEPARATOR.'base'
                                        .DIRECTORY_SEPARATOR.'functions.php';
//modules holder
$pages_fl = __ROOT__.'module_holder.php';
//layout file used for VL
$tpl_flname = __ROOT__.'layout.php';

// errors holder
$errors = array();
// module deps holder
$loaded_deps = array();
//base error constants
const ERR_BASEFN = 10;

if(file_exists($base_fns_file) && is_readable($base_fns_file)
             && file_exists($pages_fl) && is_readable($pages_fl)) {
     require_once $base_fns_file;
     $modules = require_once $pages_fl;
}
else {
    echo sprintf('Error: %d', ERR_BASEFN);
    exit();
}

$page = require_once __APPROOT__.'router.php';

if(isset($modules[$page]['depend'])) {

    foreach($modules[$page]['depend'] as $dependencie) {
        $dep_path = __MODULES__.$dependencie.DIRECTORY_SEPARATOR;

        if(isset($modules[$dependencie]['content']) &&
            check_file($modules[$dependencie]['content'], $dep_path)) {
                $loaded_deps[] = require_once $dep_path.$modules[$dependencie]['content'];
        }
        else {
            $loaded_deps = array();
            $errors [] = 'Module '.$page.' dpendencie '.$dependencie.' can\'t be loaded!';
        }
    }
}

var_dump($loaded_deps);

//variable holding all the vars that will go from BL to VL trough render
//function
$tpl_vars = compact('modules', 'page', 'errors');

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
