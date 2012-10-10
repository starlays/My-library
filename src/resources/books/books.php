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
 * Insert a book in to database
 * 
 * @param resource $mysql_link an resource object link to the database
 * @param array $book_infos containing informations about the book
 * 
 * @return bool TRUE the book was added otherwise FALSE
 */
function add_book($mysql_link, $books_info, $book_cvr_path, $book_ebook_path, $user_id) {
    
    extract($books_info);
    
    $sql_add_book = "
    INSERT INTO `books` (`title`, `id_author`, `description`, `insert_date`,
    `cvr_img_path`, `e_book_path`, `id_rate`, `id_insert_user`)
    VALUES ( '$book_title', (SELECT `id` FROM `authors` WHERE name='$book_author'), 
    '$book_description', '$book_insdate', '$book_cvr_path', '$book_ebook_path', 1, $user_id);";
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

/**
 * Retrive all the inserted books by an user from the database
 * 
 * @param resource $mysql_link an resource object link to the database
 * @param string $uID the uID of the user the books belongs to
 * @param string $order_by the criteria by witch the books are ordered
 * @param string $type order asccendent or descendentent default ASC
 * 
 * @return array $books the books retrived from the database based on given 
 *                      criteria
 */
function retrive_user_books($mysql_link, $uID, $order_by, $type) {

    $SQL = "SELECT 
    title AS book_title, name AS author_name, description AS book_description,
    insert_date AS book_insert_date FROM `books`
    INNER JOIN authors ON books.id_author = authors.id 
    WHERE id_insert_user = ".$uID." 
    ORDER BY ".$order_by." ".$type.";";

    if($result = mysqli_query($mysql_link, $SQL)) {
        if($books = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
            mysqli_free_result($result);
            return $books;
        }
    }
}

/**
 * Search a book by title
 * 
 * @param resource $mysql_link an resource object link to the database
 * @param string $book_title the title of the searched book
 * 
 * @return array $searched_books an array containing the searched results
 */
function search_book_bytitle($mysql_link, $search_title) {
    
   $sql_sbooks = "SELECT title AS book_title, name AS author_name,
                 description AS book_description,insert_date AS book_insert_date,
                 cvr_img_path AS book_cvr_img_path, e_book_path AS book_ebook_path
                 FROM `books` INNER JOIN `authors` ON books.id_author = authors.id 
                 WHERE title REGEXP '".$search_title."';";

    if($result = mysqli_query($mysql_link, $sql_sbooks)) {
        if($books = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
            mysqli_free_result($result);
            
            return $books;
        }
    }
}