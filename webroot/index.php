<?php
/**
 * Be short info here
 */

 /**
  * Application constant to prevend direct access to other php files from
  * webroot dir
  */
define('MyLibrary', TRUE);
/**
 * Require webroot config file
 */
require_once('webroot.config.php');
/**
 * Require the router
 */
require_once(APPSRC . DS . 'router.php');
