<?php
if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])) {
    $size = return_bytes(ini_get('upload_max_filesize'));
    echo '<form enctype="multipart/form-data" action="" method="post" >
	<input type="hidden" name="MAX_FILE_SIZE" value="',$size,'" />
    <input name ="file" type ="file" />
    <input type ="submit" name="file_upload" value ="Send" />
    </form>';
}

if(is_numeric($page_vl_vars)) {
    switch($page_vl_vars) {
        case UPLD_ERR_SESSION :
            echo sprintf('Cam\'t start session! Error: %d', UPLD_ERR_SESSION);
            break;
        case UPLD_NOT_LOGGED_IN:
            echo 'You are not logged in!';
            break;
        case UPLD_ERR_NOWRITEDIR:
            echo sprintf('Can\'t write in to user upload dir! Error: %d', UPLD_ERR_NOWRITEDIR);
            break;
        case UPLD_ERR_MKDIR:
            echo sprintf('Can\'t create user upload dir! Error: %d', UPLD_ERR_MKDIR);
            break;
        case UPLD_SUCCESS:
            echo 'Your file was uploaded!';
    }

}