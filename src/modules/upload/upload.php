<?php
if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])) {
    $size = return_bytes(ini_get('upload_max_filesize'));
?>
<form enctype="multipart/form-data" action="" method="post" >
	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $size ?>" />
    <input name ="file" type ="file" />
    <input type ="submit" name="file_upload" value ="Send" />
</form>
<?php
}
if(!is_null($status_code)){
    switch($status_code) {
        case UPLD_ERR_SESSION :
            echo sprintf('Cam\'t start session! Error: %d', UPLD_ERR_SESSION);
            break;
        case UPLD_NOT_LOGGED_IN:
            echo 'You are not logged in!';
            break;
        case UPLD_ERR_UPLDFILE:
            echo sprintf('File upload error: %d', UPLD_ERR_NOWRITEDIR);
            break;
        case UPLD_SUCCESS:
            echo 'Your file was uploaded!';
    }
}
