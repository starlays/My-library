<?php
/**
 * @group FileUpload File upload
 */

if(isset($_POST['file_upload'])) {
    $upld_file = $_FILES['file'];
    
    if($upld_file['error'] === UPLOAD_ERR_OK) {
         if(is_uploaded_file($upld_file['tmp_name'])){
             // here process if the user is loged in and if it is create a dir
             // inside uploads with dir name using his uuid
             // check if file is uploaded
             // move file in to user dir
             // return status codes
         }
    }
    
}