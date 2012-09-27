<?php
/**
 * Books resources
 */

/**
 * Constants
 */

/**
 * Check to see if the given author exists in database
 * 
 * @param resource $mysql_link an resource object link to the database
 * @param string $author the author name that will be checked
 * 
 * @return bool TRUE if the user exists otherwise FALSE
 */
function is_author($mysql_link, $author){
    $sql_getauthor = "SELECT `name` FROM `authors` WHERE name='$author'";
    
    if($result = mysqli_query($mysql_link, $sql_getauthor)) {
        if(mysqli_fetch_row($result)){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    else {
        return FALSE;
    }
}

/**
 * Insert given user in to database
 * 
 * @param resource $mysql_link an resource object link to the database
 * @param string $author the author name that will be inserted in to the database
 * 
 * @return bool TRUE if the user exists otherwise FALSE
 */
function insert_author($mysql_link, $author){
    $sql_ins_author = "INSERT INTO `authors` (`name`) VALUES ('$author');";
    
    //use MySQL transactions to be on the safe side
    mysqli_autocommit($mysql_link, FALSE);
    
    if(mysqli_query($mysql_link, $sql_ins_author)) {
        mysqli_commit($mysql_link);
        
        return TRUE;
    }
    else {
        mysqli_rollback($mysql_link);
        mysqli_close($mysql_link);
        
        return FALSE;
    }

}

/**
 * Insert given user in to database
 * 
 * @param resource $mysql_link an resource object link to the database
 * @param array $book_infos containing informations about the book
 * 
 * @return bool TRUE the book was added otherwise FALSE
 */
function add_book($mysql_link, $book_infos, $user_id) {
    
    list($book_title, $book_author, $book_descript, 
            $book_insdate, $book_cvr_path, $book_ebook_path) = $book_infos;
    
    $sql_add_book = "
    INSERT INTO `books` (`title`, `id_author`, `description`, `insert_date`,
    `cvr_img_path`, `e_book_path`, `id_rate`, `id_insert_user`)
    VALUES ( '$book_title', (SELECT `id` FROM `authors` WHERE name='$book_author'), 
    '$book_descript', '$book_insdate', '$book_cvr_path', '$book_ebook_path', 1, $user_id);";
    //use MySQL transactions to be on the safe side
    mysqli_autocommit($mysql_link, FALSE);
    
    if(!is_author($mysql_link, $book_author)){
        if(!insert_author($mysql_link, $book_author)) {
            
            return FALSE;
        }
    }

    if(mysqli_query($mysql_link, $sql_add_book)) {
        mysqli_commit($mysql_link);
        mysqli_close($mysql_link);
        
        return TRUE;
    }
    else {
        mysqli_rollback($mysql_link);
        mysqli_close($mysql_link);
        
        return FALSE;
    }
}