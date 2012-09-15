<?php
//resourcess loader 
$resourcess_to_load = array();

if(isset($modules[$page]['resources'])) {

    foreach($modules[$page]['resources'] as $resource) {
        $res_path = __RESOURCES__.$resource.DIRECTORY_SEPARATOR;
 
        if(isset($resources[$resource]['resource_file']) &&
            check_file($$resources[$resource]['resource_file'], $res_path)) {
                $resourcess_to_load[] =  $res_path.$resources[$resource]['resource_file'];
        }
    }
}

return $resourcess_to_load;
