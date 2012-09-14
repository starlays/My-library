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
define('__WEBROOT__', __DIR__.DIRECTORY_SEPARATOR);
//define app root
define('__APPROOT__', dirname(__WEBROOT__).DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR);
//modules path
chdir(__APPROOT__);
define('__MODULES__', __APPROOT__.'modules'.DIRECTORY_SEPARATOR);
//base app functions file
$base_fns_file  = __APPROOT__.'modules'.DIRECTORY_SEPARATOR.'base'
                                        .DIRECTORY_SEPARATOR.'functions.php';
//modules holder
$pages_fl = __APPROOT__.'module_holder.php';
//layout file used for VL
$tpl_flname = __APPROOT__.'layout.php';
//base error constants
const ERR_BASEFN    = 10;
const ERR_LDMODDEP  = 11;
const ERR_LDMODBL   = 12;
//constant returned if the module has no BL file
const MODLDBL_NO_BL = 14;
/**
 * @}
 */
if(file_exists($base_fns_file) && is_readable($base_fns_file)
             && file_exists($pages_fl) && is_readable($pages_fl)) {
     require_once $base_fns_file;
     $modules = require_once $pages_fl;
}
else {
    echo sprintf('Error: %d', ERR_BASEFN);
    exit();
}

//get the page from router
$page = require_once __APPROOT__.'router.php';

//load pre-process files
$load_preprocess_files = require_once __APPROOT__.'pre_process_loader.php';

if(!empty($load_preprocess_files)){
    foreach($load_preprocess_files as $preprocess_file){
        if($preprocess_file !== NULL){
            require_once $preprocess_file;
        }
    }
}

//variable holding all the vars that will go from BL to VL trough render
//function
$load_deps = require_once __APPROOT__.'dependency_loader.php';

if(isset($load_deps)){
    foreach($load_deps as $load_dep) {
        require_once $load_dep;
    }
}
else {
    echo sprintf('Error: %d', ERR_LDMODDEP);
    exit();
}

//load module BL
$moduleBL = require_once __APPROOT__.'moduleBL_loader.php';
$page_vl_vars = NULL;

if($moduleBL !== MODLDBL_NO_BL) {
    if($moduleBL !== NULL) {
        $page_vl_vars = require_once $moduleBL;
    }
    else {
        echo sprintf('Error: %d', ERR_LDMODBL);
        exit();
    }
}

//TODO: fix this improvization {
if(isset($books)) {
    $tpl_vars = compact('modules', 'page', 'page_vl_vars', 'books');
}
else {
    $tpl_vars = compact('modules', 'page', 'page_vl_vars');
}
// }

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
