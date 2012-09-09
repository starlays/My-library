<?php
//moudule deps loader 
$modules_to_load = array();

if(isset($modules[$page]['depend'])) {

    foreach($modules[$page]['depend'] as $dependencie) {
        $dep_path = __MODULES__.$dependencie.DIRECTORY_SEPARATOR;

        if(isset($modules[$dependencie]['content']) &&
            check_file($modules[$dependencie]['content'], $dep_path)) {
                $modules_to_load[] =  $dep_path.$modules[$dependencie]['content'];
        }
    }
}
//
return $modules_to_load;
