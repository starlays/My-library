<?php
//resourcess loader 
$resourcess_to_load = array();

if(isset($modules[$page]['resources'])) {

    foreach($modules[$page]['resources'] as $resources) {
        $res_path = __MODULES__.$resources.DIRECTORY_SEPARATOR;

        if(isset($modules[$resources]['resourcess']) &&
            check_file($modules[$resources]['resources_file'], $res_path)) {
                $resourcess_to_load[] =  $res_path.$modules[$resources]['resources_file'];
        }
    }
}

return $resourcess_to_load;
