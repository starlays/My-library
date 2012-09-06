<?php
/**
* Error constants
*/
const RENDER_OK     = 0;
const RENDER_ERFLRD = 1;
const RENDER_ERFLIS = 2;
const RENDER_EPYVAR = 3;


/**
* Render template file using vars
*
* @param $tpl_flname path to the template file
* @param $tpl_vars send variable to template file
*
*/

function render($tpl_flname, $tpl_vars = array()) {
    if(!file_exists($tpl_flname)) {
        return RENDER_ERFLIS;
    }
    if(!is_readable($tpl_flname)) {
        return RENDER_ERFLRD;
    }
    if(!$tpl_vars) {
        return RENDER_EPYVAR;
    }
    else {
        extract($tpl_vars);
    }

    require $tpl_flname;

    return RENDER_OK;
}


?>
