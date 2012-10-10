<?php
/**
 * User module BL file
 */
/**
 * Module constants
 */
const USER_ADBOOK_EYFLD   = 40;
const USER_NODB_INSERT    = 41;
const USER_DB_INSERT_OK   = 42;
const USER_SESSIONOTSTART = 43;
const USER_ERR_UPLOAD     = 44;
const USER_NOT_LOGGED_IN  = 45;
const USER_CVR_MIME_ERR   = 46;
const USER_EBOOK_MIME_ERR = 47;
/**
 * Book list container
 */
$books_list     = NULL;
/**
 * Status code container
 */
$status_code    = NULL;
/**
 * Books searched results container
 */
$searched_books = NULL;
/**
 * Cvr image status code container
 */
$cvr_img_status = NULL;
/**
 * Ebook status code container
 */
$ebook_status = NULL;
/**
 * Allowed image mime type
 */
$image_mime = array('image/pjpeg', 'image/jpeg', 'image/gif', 
                    'image/bmp', 'image/x-png', 'image/png');
/**
 * Allowed ebook mime type
 */
$ebook_mime = array('application/pdf');

if (initialize_session()){
    if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])
                                    && is_usr_logged($_SESSION['username'])) {
        $uID = $_SESSION['user_ID'];
        $books_list = retrive_user_books($mysql_link, $uID, 'title', 'ASC');

        if(isset($_POST['usr_add_book'])) {
            $book_cvrimg = NULL;
            $book_ebook  = NULL;
            $required_info = array(
                'book_title'       => $_POST['book_title'],
                'book_author'      => $_POST['book_author'], 
                'book_description' => $_POST['book_descript'], 
                'book_insdate'     => $_POST['book_insdate']
            );

            if(isset($_FILES['book_cvrimg'])) {
                $book_cvrimg = $_FILES['book_cvrimg'];
            }
            if(isset($_FILES['book_ebook'])) {
                $book_ebook  = $_FILES['book_ebook'];
            }
            //TODO: Better form validation, check every case, check if field type is coresponding    
            if(!isEmpty_array_vals($required_info)) {

                $required_info = datafilter($required_info);

                //TODO: Use prepared statements instead
                foreach($required_info as $data) {
                        mysqli_real_escape_string($mysql_link, $data);
                }

                $cvr_upld_dir   = mysqli_real_escape_string($mysql_link,
                        __UPLOADS__.$_POST['book_title'].D_S.'cvr_img'.D_S);
                $ebook_upld_dir = mysqli_real_escape_string($mysql_link, 
                        __UPLOADS__.$_POST['book_title'].D_S.'ebook'.D_S);
                
                if(!is_null($book_cvrimg) && !empty($book_cvrimg['name'])) {
                    if(is_mime_accepted($book_cvrimg, $image_mime)) {
                        if(!user_upload($book_cvrimg, $cvr_upld_dir)){
                            $status_code = USER_ERR_UPLOAD;
                        }
                    }
                    else {
                        $cvr_img_status = USER_CVR_MIME_ERR;
                    }
                }
                if(!is_null($book_ebook) && !empty($book_ebook['name'])) {
                    if(is_mime_accepted($book_ebook, $ebook_mime)) {
                        if(!user_upload($book_ebook, $ebook_upld_dir)){
                            $status_code = USER_ERR_UPLOAD;
                        }
                    }
                    else {
                        $ebook_status = USER_EBOOK_MIME_ERR;
                    }
                }

                if(add_book($mysql_link, $required_info, 
                                        $cvr_upld_dir, $ebook_upld_dir, $uID)) {
                    $status_code = USER_DB_INSERT_OK;
                }
                else {
                    $status_code = USER_NODB_INSERT;
                }
            }
            else {
                $status_code = USER_ADBOOK_EYFLD; 
            }
        }
        elseif(isset($_POST['delete_book'])) {
            if(isset($_POST['rm_books'])) {
                $rm_books = datafilter($_POST['rm_books']);
                $rm_books = implode("','", $rm_books);

                $sql_dbooks = "DELETE FROM `books` WHERE `title` IN ('$rm_books');";
                mysqli_query($mysql_link, $sql_dbooks);
                mysqli_close($mysql_link);
            }
        }
        elseif(isset($_POST['search_book'])) {
            if(isset($_POST['search_title'])) {
                $search_title = $_POST['search_title'];

                $searched_books = search_book_bytitle($mysql_link, $search_title);
            }
        }
    }
    else {
        $status_code = USER_NOT_LOGGED_IN;
    }
}
else {
    $status_code = USER_SESSIONOTSTART; 
}

return array(
    'books_list'     => $books_list,
    'status_code'    => $status_code,
    'searched_books' => $searched_books,
    'cvr_img_status' => $cvr_img_status,
    'ebook_status'   => $ebook_status
    );
