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

/**
 * Send a message to a given e-mail from a given e-mail with a given 
 * e-mail body
 * 
 * @param string $from_user the email that sends the e-mail
 * @param string $to_email the addres that the e-mail will go
 * @param string $subject the email subject
 * @param string $email_body the content of the e-mail
 * 
 * @return bool TRUE if the e-mail was delivered false otherwise. Warning: 
 * returns TRUE if e-mail was delivereded!! there is no guaranty that the e-mail
 * hase reached destination
 */

function email_infos($from_email, $to_email, $subject, $email_body) {
     
    $headers = 'From: ' .$from_email. "\r\n";
    $headers.= 'Reply-To: ' .$to_email. "\r\n";
    $headers.= 'X-Mailer: PHP/' . phpversion();
    
    if(mail($to_email,$subject,$email_body, $headers)) {
        return TRUE;
    }
    return FALSE;
}

/**
 * Generates 5 links with book id, author id and rate id.
 * 
 * string rate_links_gen($page, $uID, $bID)
 * 
 * @param string $page, the page user is on
 * @param string $uID, the userd id
 * @param string $bID, the book id
 * 
 * @return string $rate_links, rate stars links
 */

function rate_links_gen($page,$uID,$bID) {
     $rate_links = NULL;
     for($i=1;$i<=5;$i++){
         $rate_links .= 
            '<td>
                <a href="?page='.$page.'&uID='.$uID.
                                                   '&bID='.$bID.
                                                   '&rID='.$i.'">
                    <img src="star.png" alt="Give '.$i.' '.(1===$i?'Star':'Stars').'" 
                        width="32" height="32"/>
                </a>
            </td>';
     }
     return $rate_links;
}

/**
 * Check if an uID already rated a bID.
 * 
 * bool rating_check()
 * 
 * @param $mysql_link, an resource object link to the database
 * @param $uID, the user id
 * @param $bID, the book id
 * @param $rID, the rate id
 * 
 * @return TRUE if user rated or FALSE
 */

function rating_check($mysql_link,$uID,$bID,$rID=null) {
    
    $SQL = "SELECT COUNT(*) AS nr FROM `user_book_rating` 
        WHERE `id_user`=".$uID." AND `id_book`=".$bID."";
    
    if(func_num_args()===4) {
        if(is_int(func_get_arg(3))) {
            $SQL.= "  AND `id_rate`='".$rID."';";
        }
    }
    
    $qresult = mysqli_query($mysql_link, $SQL);
    $qresult = mysqli_fetch_assoc($qresult);
    
    if(1 === (int)$qresult['nr']) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Retrives from db the avarage of a book rate.
 * 
 * int check_rating()
 * 
 * @param $mysql_link, an resource object link to the database
 * @param $bID, the book id
 * 
 * @return string $qresult['AVG']
 */

function rating_avg($mysql_link,$bID) {
    
    $SQL = "SELECT ROUND(AVG(id_rate)) AS 'AVG' FROM `user_book_rating` 
        WHERE `id_book`=".$bID.";";
    
    $qresult = mysqli_query($mysql_link, $SQL);
    $qresult = mysqli_fetch_assoc($qresult);
    
    if('null' != $qresult['AVG']){
        return $qresult['AVG'];
    }
}

/**
 * Add a book rate by the logged-in user.
 * 
 * bool rating_insert()
 * 
 * @param $mysql_link, an resource object link to the database
 * @param $uID, the user id
 * @param $bID, the book id
 * @param $rID, the rate id
 * 
 * @return TRUE on succes or FALSE
 */

function rating_insert($mysql_link,$uID,$bID,$rID) {
    
    if (rating_check($mysql_link,$uID,$bID)){
        
        $SQL = "UPDATE `user_book_rating` 
            SET `id_rate`=".$rID."
            WHERE `id_user`=".$uID." AND `id_book`=".$bID.";";
        
        if(mysqli_query($mysql_link, $SQL)){
            return TRUE;
        }
        else {
            return FALSE;
        }
        // werify if cookie is expired to let the user rate again 
    }
    else{
        
        $SQL = "INSERT INTO `user_book_rating`(`id_user`, `id_book`, `id_rate`) 
        VALUES (".$uID.",".$bID.",".$rID.");";
        
        if(mysqli_query($mysql_link, $SQL)){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    // set a cookie with expiration date, user id and book id!
}
