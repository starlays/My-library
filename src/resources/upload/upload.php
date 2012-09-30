<?php
/**
 * Upload resource
 */

/**
 * Resource error constants:
 */

/**
 * Checks if the given upload dir exists and it is writable otherwise create it
 * 
 * @param array $upld_file the uploaded file obtained from the superglobal $_FILES['file']
 * @param string $file_upld_dir the directory that should be checked or created
 * 
 * @return bool TRUE if the file was uploaded with success FALSE otherwise
 */
function user_upload($upld_file, $file_upld_dir) {

    if($upld_file['error'] === UPLOAD_ERR_OK) {
         if(is_uploaded_file($upld_file['tmp_name'])){

             if(is_dir($file_upld_dir)) {
                 if(!is_writable($file_upld_dir)) {
                     
                     return FALSE;
                 }
             }
             else {
                 umask(0003);
                 if(!mkdir($file_upld_dir,0774, TRUE)){

                     return FALSE;
                 }
             }
             if(move_uploaded_file($upld_file['tmp_name'], 
                     $file_upld_dir.D_S.$upld_file['name'])) {

                 return TRUE;
             }
         }
         else {
             return FALSE;
         }
    }
}