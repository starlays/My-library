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
const UPLD_NO_ACTION      = 119;
/**
 * Status code container
 */
$status_code = NULL;

if(initialize_session()) {
    if(isset($_SESSION['username']) && is_usr_logged($_SESSION['username'])) {
        
        if(isset($_POST['file_upload'])) {
            $upld_file = $_FILES['file'];
            $usr_upld_dir = __UPLOADS__.$_SESSION['user_ID'];
            
            if(user_upload($upld_file,$usr_upld_dir)){
                $status_code = UPLD_SUCCESS;
            }
            else {
                $status_code = UPLD_ERR_UPLDFILE;
            }
        }
    }
    else {
        $status_code = UPLD_NOT_LOGGED_IN;
    }
}
else {
    $status_code = UPLD_ERR_SESSION;
}

return array(
    'status_code' => $status_code
    );