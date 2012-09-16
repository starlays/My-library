<?php
$pre_processes_toload = array();

if(isset($modules[$page]['pre-processing'])) {
    foreach($modules[$page]['pre-processing'] as $preprocmodule => $preprocfile){

        $preprocess_path = __MODULES__.$preprocmodule.DIRECTORY_SEPARATOR;

        if(check_file($modules[$page]['pre-processing'][$preprocmodule],$preprocess_path)) {
            $pre_processes_toload[] = $preprocess_path.$modules[$page]['pre-processing'][$preprocmodule];
        }
        else {
            $pre_processes_toload[] = NULL;
        }
    }
}

return $pre_processes_toload;
