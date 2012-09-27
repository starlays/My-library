<?php
//error const
const USER_ADBOOK_EYFLD   = 40;
const USER_NODB_INSERT    = 41;
const USER_DB_INSERT_OK   = 42;
const USER_SESSIONOTSTART = 43;
const USER_ERR_UPLOAD     = 44;
const USER_NOT_LOGGED_IN  = 45;

if (initialize_session()){
    if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])
                                    && is_usr_logged($_SESSION['username'])) {
        if(isset($_POST['usr_add_book'])) {
            $book_cvrimg = NULL;
            $book_ebook  = NULL;
            $required_info = array($_POST['book_title'], $_POST['book_author'], 
                                    $_POST['book_descript'], $_POST['book_insdate']);

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

                $cvr_upld_dir   =mysqli_real_escape_string($mysql_link,
                        __UPLOADS__.$_POST['book_title'].D_S.'cvr_img'.D_S);
                $ebook_upld_dir = mysqli_real_escape_string($mysql_link, 
                        __UPLOADS__.$_POST['book_title'].D_S.'ebook'.D_S);
                
                if(!is_null($book_cvrimg) && !empty($book_cvrimg['name'])) {
                    if(!user_upload($book_cvrimg, $cvr_upld_dir)){
                        return USER_ERR_UPLOAD;
                    }
                }
                if(!is_null($book_ebook) && !empty($book_ebook['name'])) {
                    if(!user_upload($book_ebook, $ebook_upld_dir)){
                        return USER_ERR_UPLOAD;
                    }
                }
                //optional informatin default value processing
                $uID = $_SESSION['user_ID'];
                $required_info[] = $cvr_upld_dir;
                $required_info[] = $ebook_upld_dir;

                if(add_book($mysql_link, $required_info, $uID)){

                    return USER_DB_INSERT_OK;
                }
                else {
                    return USER_NODB_INSERT;
                }
            }
            else {
                return USER_ADBOOK_EYFLD;
            }
        }
        elseif(isset($_POST['delete_book'])) {
            if(isset($_POST['rm_books'])) {
                $rm_books = datafilter($_POST['rm_books']);
                $rm_books = implode(',', $rm_books);

                $sql_dbooks = "DELETE FROM `books` WHERE `title` IN ('$rm_books');";
                mysqli_query($mysql_link, $sql_dbooks);
                mysqli_close($mysql_link);
            }
        }
        elseif(isset($_POST['search_book'])) {
            if(isset($_POST['search_title'])) {
                $search_title = $_POST['search_title'];


                $sql_sbooks = "SELECT title AS book_title, name AS author_name, 
                    description AS book_description,
                insert_date AS book_insert_date, cvr_img_path AS book_cvr_img_path,
                e_book_path AS book_ebook_path
                 FROM `books` INNER JOIN `authors` ON books.id_author = authors.id 
                 WHERE title REGEXP '".$search_title."';";

                $query = mysqli_query($mysql_link, $sql_sbooks);
                return mysqli_fetch_row($query);
                mysqli_close($mysql_link);
             } 
        }
    }
    else {
        return USER_NOT_LOGGED_IN;
    }
}
else {
    return USER_SESSIONOTSTART;
}
