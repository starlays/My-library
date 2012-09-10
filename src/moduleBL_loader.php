<?php

//path to module BL file
$moduleBL_path = __MODULES__.$page.DIRECTORY_SEPARATOR;

if(isset($modules[$page]['content_BL'])) {
    if(check_file($modules[$page]['content_BL'],$moduleBL_path)) {
        return $moduleBL_path.$modules[$page]['content_BL'];
    }
    else {
        return NULL;
    }
}
else {
    return MODLDBL_NO_BL;
}