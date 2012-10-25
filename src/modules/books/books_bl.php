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
const ERR_RATEBOOK        = 344;
const ERR_ALREADYRATED    = 345;
const SUCCESS_BOOKRATED   = 346;

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
                    else {
                        $books[$key]['book_img'] = NULL;
                    }
                    if(check_dir($book['e_book_path'])) {
                        $books[$key]['book_ebook'] = array(
                            files_scand_dir($book['e_book_path'], $ebook_mime)
                            );
                    }
                    else {
                        $books[$key]['book_ebook'] = NULL;
                    }
                }
            }
        }
        if(isset($_POST['email_books'])) {
            if(isset($_POST['email_books_collection']) 
                    && !empty($_POST['email_books_collection'])) {
                
                $from_email     = 'noreply@my-library.com';
                $subject        = $_SESSION['username'].' favorite books';
                $email_bookslst = implode(', ', $_POST['email_books_collection']);
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
                if(!email_infos($from_email, '/*email here*/', $subject, $email_body)) {
                    $status_code = BOOKS_ERR_EMAILSEND;
                }
            }
        }
    }
    else {
        $status_code = BOOKS_NOT_LOGGED; 
    }
    if (isset($_GET['uID'],$_GET['bID'],$_GET['rID']) && 
            !empty($_GET['uID']) && !empty($_GET['bID']) && !empty($_GET['rID'])){
        
        $uID = (int)strip_tags($_GET['uID']);
        $bID = (int)strip_tags($_GET['bID']);
        $rID = (int)strip_tags($_GET['rID']);
        
        
        
        if(($uID >= 1) && ($bID >= 1) && ($rID >= 1)){
            if (!rating_check($mysql_link,$uID,$bID,$rID)){
                if(rating_insert($mysql_link,$uID,$bID,$rID)){
                    $status_code = SUCCESS_BOOKRATED;
                }
                else{
                    $status_code = ERR_RATEBOOK;
                }
            }
            else{
                $status_code = ERR_ALREADYRATED;
            }
        }
        else{
            $status_code = ERR_RATEBOOK;
        }
    }
}

return array(
    'status_code'  => $status_code,
    'books'        => $books,
    'mysql_link'   => $mysql_link,
    );