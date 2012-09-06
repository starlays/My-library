<?php
//define file constants
define('BASE_FUNCTION', '..'.DIRECTORY_SEPARATOR.'functions'
                            .DIRECTORY_SEPARATOR.'base'.DIRECTORY_SEPARATOR.'functions.php');
//error constants
const ERR_BASEFN = 0;

if(file_exists(BASE_FUNCTION) && is_readable(BASE_FUNCTION)) {
    require_once (BASE_FUNCTION);
}
else {
    return ERR_BASEFN;
}

