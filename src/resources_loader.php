<?php
//resources loader 
$resources_to_load = array();

if(isset($modules[$page]['resource'])) {

    foreach($modules[$page]['resource'] as $resource) {
        $res_path = __MODULES__.$resource.DIRECTORY_SEPARATOR;

        if(isset($modules[$resource]['resources']) &&
            check_file($modules[$resource]['resource_file'], $res_path)) {
                $resources_to_load[] =  $res_path.$modules[$resource]['resource_file'];
        }
    }
}

return $resources_to_load;
