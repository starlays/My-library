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

/**
 * Check if the recived file corresponds to the given mime type
 * 
 * @param array $upld_file the uploaded file obtained from the superglobal $_FILES['file']
 * @param array $mime_type_list an list with accepted mime types
 * 
 * @return bool TRUE if the file is an image otherwise FALSE
 */
function is_mime_accepted($upld_file, $mime_type_list) {
   $upld_file_mime = NULL;
    
   if(isset($upld_file['type'])) {
       $upld_file_mime = $upld_file['type'];
   }
   else {
        if (!$finfo = finfo_open(FILEINFO_MIME_TYPE)) { /* get the predefinded mime type from extension */
            return FALSE; /* can't load the extension database */
        }
        /* get mime-type for the uploaded file */
        $upld_file_mime = finfo_file($finfo, $upld_file['tmp_name']);
        /* close connection */
        finfo_close($finfo);
   }
    
    if(!is_null($upld_file_mime) && in_array($upld_file_mime, $mime_type_list)) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}