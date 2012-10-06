<?php
/**
 * @file index.php
 * @brief Application main file and integrator
 * @author Lazar Florentin <florentin[dot]lazar[at]gmail[dot]com>
 * @author Dicu George <john.doe@example.com>
 * 
 * @mainpage
 * 
 * @section About
 * Project developed while learning php programming under the organization
 * <a href="http://yet-another-project.github.com/" title="YAP - ROPHP">
 * Yet another project: RO PHP BOOK</a>
 * Project manager: Flavius Aspra
 * 
 * @section Modules
 * All the pages are considered modules. Modules alawys have an presentation
 * file (view logic) that outputs data basing on the vars recived from the module
 * processing file (business logic)
 * 
 * @section Resources modules
 * This type of "modules" are mainly resurce provider files
 * 
 * @section License
 * (C) Copyright 2011 PauLLiK
 *
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see http://www.gnu.org/licenses/.
 */
/**
 * @defgroup GLOBALCONSTANTS this are the application global constants
 * @{
 */
/**
 * base error constants
 */
const ERR_BASEFN      = 10;
const ERR_LDMODBL     = 12;
const ERR_LDMODDEPRES = 14;
/**
 * constant returned if the module has no BL file
 */
const MODLDBL_NO_BL   = 15;
/**
 * constant returned if the upload direcotry is missing
 */
const ERR_UPLDDIR     = 16;
/**
 * Directory separator constant
 */
const D_S = DIRECTORY_SEPARATOR;

/**
 * Define webroot
 */
define('__WEBROOT__', __DIR__.D_S);
/**
 * define app root
 */
define('__APPROOT__', dirname(__WEBROOT__).D_S.'src'.D_S);
chdir(__APPROOT__);
/**
 * modules path
 */
define('__MODULES__', __APPROOT__.'modules'.D_S);
/**
 * resources path
 */
define('__RESOURCES__', __APPROOT__.'resources'.D_S);
/**
 * uploads location
 * Note: upload dir must be owned by your apache user
 */
define('__UPLOADS__', dirname(__WEBROOT__).D_S.'uploads'.D_S);
/**
 * base app functions file
 */
$base_fns_file  = __APPROOT__.'resources'.D_S.'base'
                                        .D_S.'functions.php';
/**
 * modules holder
 */
$pages_fl = __APPROOT__.'module_holder.php';
/**
 * resource holder
 */
$resources_fl = __APPROOT__.'resource_holder.php';
/**
 * layout file used for VL
 */
$tpl_flname = __APPROOT__.'layout.php';
/**
 * Conainer for view logic vars
 */
$view_vars = array();
/**
 * @}
 */

if(file_exists($base_fns_file) && is_readable($base_fns_file)
        && file_exists($pages_fl) && is_readable($pages_fl)
        && file_exists($resources_fl) && is_readable($resources_fl)) {
     require_once $base_fns_file;
     $modules   = require_once $pages_fl;
     $resources = require_once $resources_fl;
}
else {
    echo sprintf('Error: %d', ERR_BASEFN);
    exit();
}
/**
 * Check if UPLOADS dir exists and it is writable
 */
if(!check_dir(__UPLOADS__)) {
    echo sprintf('Error: %d', ERR_UPLDDIR);
    exit();
}

//get the page from router
$page = require_once __APPROOT__.'router.php';

// module resource dependency loader
$load_resdeps = require_once __APPROOT__.'resources_loader.php';

if(isset($load_resdeps)){
    foreach($load_resdeps as $load_resdep) {
        require_once $load_resdep;
    }
}
else {
    echo sprintf('Error: %d', ERR_LDMODDEPRES);
    exit();
}

//load module BL file
$moduleBL = require_once __APPROOT__.'moduleBL_loader.php';

if($moduleBL !== MODLDBL_NO_BL) {
    if($moduleBL !== NULL) {
        $view_vars = require_once $moduleBL;
    }
    else {
        echo sprintf('Error: %d', ERR_LDMODBL);
        exit();
    }
}

$view_vars['active_page_title']  = $modules[$page]['title'];
$view_vars['active_page']        = $page;

foreach($modules as $metadata => $data) {
    if(isset($modules[$metadata]['in_menu']) && !empty($modules[$metadata]['in_menu'])){
        $view_vars['menu_items'][$metadata]['name']        = $modules[$metadata]['title'];
        $view_vars['menu_items'][$metadata]['menu_number'] = $modules[$metadata]['in_menu'];
        $view_vars['menu_items'][$metadata]['content_VL']  = $modules[$metadata]['content_VL'];
    }
}

$render = render($tpl_flname, $view_vars);

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
