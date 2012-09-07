<?php
/**
 * Error constants
 */
const RENDER_ERFLRD = 0;
const RENDER_ERFLIS = 1;
const RENDER_EPYVAR = 2;
const RENDER_OK     = 3;


/**
 * Render template file using received vars
 *
 * @param string $tpl_flname path to the template file
 * @param array  $tpl_vars send variable to template file
 *
 * @return integer STATUS_CODE
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

/**
 * Builds html menu from given array
 *
 * @param string $active_menu
 * @param array $menu_values
 *
 * @return string html menu
 */
function build_menu($active_menu, $menu_values=array()){
    $menu = '<ul id="menu">' .PHP_EOL;
    foreach($menu_values as $metadata=>$values){
        if($active_menu == $metadata){
                $menu .= '<li class="title">'.$menu_values[$metadata]['title'].'</li>'.PHP_EOL;
            }
            else{
                $menu .= '<li class="menu"><a href="?page='.$metadata.'">'
                    .$menu_values[$metadata]['title'].'</a></li>'.PHP_EOL;
            }
        }
    $menu .= '</ul>' .PHP_EOL;

    return $menu;
}


