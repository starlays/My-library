<?php
$post_procees_toload = array();

if(isset($modules[$page]['prost-processing'])) {
    foreach($modules[$page]['prost-processing'] as $postprocmodule => $preprocfile){
    
        $postprocess_path = __MODULES__.$postprocmodule.DIRECTORY_SEPARATOR;
         
        if(check_file($modules[$page]['prost-processing'][$postprocmodule],$postprocess_path)) {
            $post_procees_toload[] = $postprocess_path.$modules[$page]['prost-processing'][$postprocmodule];
        }
        else {
            $post_procees_toload[] = NULL;
        }
    }
}

return $pre_procees_toload;