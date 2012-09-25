<?php
/**
 * @group FileUpload File upload
 */

/**
 * Constants returned by upload module
 */
const UPLD_ERR_SESSION    = 115;
const UPLD_NOT_LOGGED_IN  = 116;
const UPLD_ERR_UPLDFILE   = 117;
const UPLD_SUCCESS        = 118;

if(initialize_session()) {
    if(isset($_SESSION['username']) && is_usr_logged($_SESSION['username'])) {
        
        if(isset($_POST['file_upload'])) {
            $upld_file = $_FILES['file'];
            $usr_upld_dir = __UPLOADS__.$_SESSION['user_ID'];
            
            if(user_upload($upld_file,$usr_upld_dir)){
                return UPLD_SUCCESS;
            }
            else {
                return UPLD_ERR_UPLDFILE;
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