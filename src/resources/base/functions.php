<?php
/**
 * Error constants returned by functions
 * See functions signature to locate the functions that return them.
 */
const RENDER_ERFLRD  = 0;
const RENDER_ERFLIS  = 1;
const RENDER_EPYVAR  = 2;
const RENDER_OK      = 3;

/**
 * Render template file using received vars
 *
 * @param string $tpl_flname path to the template file
 * @param array  $tpl_vars send variable to template file
 *
 * @return integer STATUS_CODE
 *  RENDER_ERFLIS  - if $tpl_flname is missing
 *  RENDER_ERFLRD  - if $tpl_flname is not readable
 *  RENDER_EPYVAR  - it $tpl_vars is empty
 *  RENDER_OK      - all went OK
 */
function render($tpl_flname, $tpl_vars = array()) {

    if(!file_exists($tpl_flname)) {
        return RENDER_ERFLIS;
    }
    if(!is_readable($tpl_flname)) {
        return RENDER_ERFLRD;
    }
    if(!$tpl_vars) {
        return RENDER_EPYVAR;
    }
    else {
        extract($tpl_vars);
    }

    require $tpl_flname;

    return RENDER_OK;
}

//TODO: fix function, decouple external dependencies
/**
 * Builds html menu from given array
 *
 * @param string $active_menu
 * @param array  $menu_values
 * @param array  $menu_number chooses witch module appears
 *
 * @return string html menu
 */
function build_menu($active_menu, $menu_values=array(), $menu_number) {

    $menu = '<ul id="menu">' .PHP_EOL;

    foreach($menu_values as $metadata=>$values) {
        if($menu_values[$metadata]['menu_number'] === $menu_number) {
            if($active_menu == $metadata) {
                    $menu .= '<li class="title">'.$menu_values[$metadata]['name'].'</li>'.PHP_EOL;
                }
                else{
                    $menu .= '<li class="menu"><a href="?page='.$metadata.'">'
                        .$menu_values[$metadata]['name'].'</a></li>'.PHP_EOL;
                }
        }
    }
    $menu .= '</ul>' .PHP_EOL;

    return $menu;
}

/**
 * Builds greetings using session
 *
 * @return string , gteetings 
 */
function build_greetings($id_name) {
    if(isset($_SESSION['username'])){
        $greetings =  '<p id='.$id_name.'>Hello '.$_SESSION['last_name'].' '.$_SESSION['first_name'].'!</p>';
    }
    else {
        $greetings = '<p id='.$id_name.'>Not Logged in!</p>';
    }
    return $greetings;
}

/**
 * Check if the given file exist and it is readable
 *
 * @param string $file file to be check
 * @param string $path_file the path to file
 *
 * @return bool
 */
function check_file($file, $path_file) {
    if(file_exists($path_file.D_S.$file)
         && is_readable($path_file.D_S.$file)) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Check if the given directory exists and is writable
 *
 * @param string $dir directory that will be checked
 *
 * @return bool
 */
function check_dir($dir) {
    if(file_exists($dir) && is_dir($dir) && is_writable($dir)) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Check if the elements of the given array are empty
 *
 * @param array $checked_array the array to check
 *
 * @return bool TRUE if an element of the array is empty otherwise FALSE
 */
function isEmpty_array_vals($checked_array) {
    foreach($checked_array as $input){
        if(empty($input)){
            return TRUE;
        }
    }
    return FALSE;
}

/**
 * Validate user input data
 *
 * @param array $array, the array to check
 *
 * @return array
 */
function datafilter($inputs) {
    $associative_array = FALSE;
    $result            = array();
    $array_keys        = array_keys($inputs);

    foreach($array_keys as $key) {
        if(!is_numeric($key)){
             $associative_array = TRUE;
             break;
        }
    }
    
    if($associative_array) {
        foreach($inputs as $metadata => $data){
            $result[$metadata] = strip_tags($data);
        }
    }
    else {
        foreach($inputs as $data){
            $result[] = strip_tags($data);
        }
    }
    
    return $result;
}

/**
 * Convert M to bytes
 * 
 * @param string $convert_val
 *
 * @return bytes representation
 */
function return_bytes($convert_val) {
    $convert_val = trim($convert_val);
    $last = $convert_val[strlen($convert_val)-1];

    switch($last) {
        case 'g':
        case 'G':
            $convert_val *= 1024;
        case 'm':
        case 'M':
            $convert_val *= 1024;
        case 'k':
        case 'K':
            $convert_val *= 1024;
    }
    return $convert_val;
}

/**
 * Retrive associative data in an array
 * 
 * @param resource $mysql_link an resource link to the database
 * @param string $sql the SQL qery that will be passed to MySQL
 * 
 * @return mixed $informations the associative array or FALSE on error
 */
function retrive_assoc($mysql_link, $sql = NULL) {
     $result = mysqli_query($mysql_link,$sql);
     
     if($informations = mysqli_fetch_assoc($result)) {
         return $informations;
     }
     else{
         return FALSE;
     }
}

/**
 * Scan a given dir for given mime type
 * 
 * @param string $path the path which contains the files
 * @param array $mime_type an list containing mime type for the 
 *  
 * @return array $readed_files an array containing all the files that exists in path
 */
function files_scand_dir($path, $mime_type) {
    $readed_files = NULL;
    
    if (!$finfo = finfo_open(FILEINFO_MIME_TYPE)) { /* get the predefinded mime type from extension */
            return FALSE; /* can't load the extension database */
    }
    
    if ($handle = opendir($path)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $file_mime = finfo_file($finfo, $path.$entry);
                 if(in_array($file_mime, $mime_type)) {
                    $readed_files[] = $entry;
                }
            }
        }
        closedir($handle);
    }
    /* close connection */
    finfo_close($finfo);
    
    return $readed_files;
}