<?php
//moudule deps loader 
$modules_to_load = array();

if(isset($modules[$page]['depend'])) {

    foreach($modules[$page]['depend'] as $dependencie) {
        $dep_path = __MODULES__.$dependencie.D_S;

        if(isset($modules[$dependencie]['content_BL']) &&
            check_file($modules[$dependencie]['content_BL'], $dep_path)) {
                $modules_to_load[] =  $dep_path.$modules[$dependencie]['content_BL'];
        }
    }
}

return $modules_to_load;
