<?php
/**
 * Webroot configuration file
 */

/**
 * Prevent this file direct access
 */
if(!defined('MyLibrary')) {
    header("HTTP/1.1 403.8 Site access denied");
    header("Status: 403.8 Site access denied");
    exit('Access forbiten!');
}
/**
 * Get direcotry separator specified by OS. Do not chage this.
 */
define('DS', DIRECTORY_SEPARATOR);
/**
 * The location where this file will be is the webroot.
 * In webroot dir are located all the static assets
 */
define('WEBROOT', __DIR__.DS);
 /**
  * Application source file
  */
define('APPSRC', dirname(WEBROOT).DS.'src'.DS);
