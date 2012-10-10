<?php
/**
 * books module
 */
/**
 * Constants
 */
const BOOKS_NOT_LOGGED = 340;
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
    }
    else {
        $status_code = BOOKS_NOT_LOGGED; 
    }
}

return array(
    'status_code'  => $status_code,
    'books'        => $books,
    );