<?php
/**
 * books module
 */
/**
 * Constants
 */
const BOOKS_NOT_LOGGED    = 340;
const BOOKS_ERR_EMAIL_BK  = 341;
const BOOKS_ERR_EMAIL_TP  = 342;
const BOOKS_ERR_EMAILSEND = 343;
/**
 * User book list conainer
 */
$books = NULL;
/**
 * Status code container
 */
$status_code = NULL;
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
        // if we have an mysql connection retrive the ncessary data out of the database
        if($mysql_link) {
            
            $uID = $_SESSION['user_ID'];
            $default_order = 'title';
            $default_asc   = 'ASC';

            if(isset($_POST['reorder'])) {
                $default_order = $_POST['ordering'];
                $default_asc   = $_POST['asc'];
            }
            $books = retrive_user_books($mysql_link, $uID, $default_order, $default_asc);

            if(isset($books)) {
                foreach($books as $key => $book) {
                     if(check_dir($book['cvr_img_path'])){
                        $books[$key]['book_img'] = array(
                               files_scand_dir($book['cvr_img_path'], $image_mime)
                                );
                    }
                    if(check_dir($book['e_book_path'])) {
                        $books[$key]['book_ebook'] = array(
                            files_scand_dir($book['e_book_path'], $ebook_mime)
                            );
                    }
                }
            }
        }
        if(isset($_POST['email_books'])) {
            if(isset($_POST['email_books_collection']) 
                    && !empty($_POST['email_books_collection'])) {
                
                $from_email     = 'noreply@my-library.com';
                $subject        = $_SESSION['username'].' favorite books';
                $email_bookslst = $_POST['email_books_collection'];
                $email_tpl_path = __MODULES__.'books'.D_S;
                $email_body     = NULL;
                $var_holders    = array('%user_name%', '%email_addres%', '%books_list%');
                //TODO: get user reg e-mail
                $var_replacers  = array($_SESSION['username'], 'foo@bar.com' ,$email_bookslst);
                
                if(check_file('email_bk_title.php',$email_tpl_path)) {
                    $email_body = require_once $email_tpl_path.'email_bk_title.php';
                }
                else {
                    $status_code = BOOKS_ERR_EMAIL_TP;
                }
                
                if(!is_string($email_body)) {
                    $status_code = BOOKS_ERR_EMAIL_BK;
                }
                else {
                    $email_body = str_replace($var_holders, $var_replacers, $email_body);
                }
                //TODO: get the e-mail from a form in books, /!\ask if it is ok!
                if(!email_infos($from_email, 'foo@bar.com', $subject, $email_body)) {
                    $status_code = BOOKS_ERR_EMAILSEND;
                }
            }
        }
    }
    else {
        $status_code = BOOKS_NOT_LOGGED; 
    }
}

return array(
    'status_code'  => $status_code,
    'books'        => $books,
    );