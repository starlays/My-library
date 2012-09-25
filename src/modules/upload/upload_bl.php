<?php
/**
 * @group FileUpload File upload
 */

/**
 * Constants returned by upload module
 */
const UPLD_ERR_SESSION    = 115;
const UPLD_NOT_LOGGED_IN  = 116;
const UPLD_ERR_NOWRITEDIR = 117;
const UPLD_ERR_MKDIR      = 118;
const UPLD_SUCCESS        = 119;

if(initialize_session()) {
    if(isset($_SESSION['username']) && is_usr_logged($_SESSION['username'])) {
        
        if(isset($_POST['file_upload'])) {
            $upld_file = $_FILES['file'];

            if($upld_file['error'] === UPLOAD_ERR_OK) {
                 if(is_uploaded_file($upld_file['tmp_name'])){
                     $usr_upld_dir = __UPLOADS__.$_SESSION['user_ID'];
                     
                     if(is_dir($usr_upld_dir)) {
                         if(!is_writable($usr_upld_dir)) {
                             
                             return UPLD_ERR_NOWRITEDIR;
                         }
                     }
                     else {
                         umask(0003);
                         if(!mkdir($usr_upld_dir,0774)){
                             
                             return UPLD_ERR_MKDIR;
                         }
                     }
                     if(move_uploaded_file($upld_file['tmp_name'], 
                             $usr_upld_dir.DIRECTORY_SEPARATOR.$upld_file['name'])) {
                         
                         return UPLD_SUCCESS;
                     }
                     
                 }
            }
        }
    }
    else {
        return UPLD_NOT_LOGGED_IN;
    }
}
else {
    return UPLD_ERR_SESSION;
}