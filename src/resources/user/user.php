<?php
/**
 * User module resource file
 */

/**
 * Retrive all admin messages from database
 * retrive_admin_messages($mysql_link)
 * 
 * @param resource $mysql_link an resource object link to the database
 * 
 * @return array $admin_messages, the messages retrived from database
 */
function retrive_admin_messages($mysql_link) {

    $SQL = "SELECT `message`,`date`,(SELECT `username` FROM `users` WHERE users.id=admin_msg.id_admin) AS `admin_name`  FROM `admin_msg` 
            ORDER BY `date` ASC;";

    if($result = mysqli_query($mysql_link, $SQL)) {
        if($admin_messages = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
            mysqli_free_result($result);
            return $admin_messages;
        }
    }
}

/**
 * Return the rights that an user has on his books
 * mixed get_user_books_rights($mysql_link, $username)
 * 
 * @param resource $mysql_link an resource object link to the database
 * @param string $username the username that books and rights on books will be checked
 * 
 * @return mixed $books_rights an array containing the books title with the user 
 * rights on thous books or false on error
 */

function get_user_books_rights($mysql_link, $username) {
    
    $SQL  = "SELECT LPAD(books.rights & users.rights, 4, '0') AS computed_rights ";
    $SQL .= "FROM   books,users ";
    $SQL .= "WHERE  books.id_insert_user = users.id ";
    $SQL .= "       AND users.username ='".$username."'";

    if($result = mysqli_query($mysql_link, $SQL)) {
        if($book_rights = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
            mysqli_free_result($result);
            return $book_rights;
        }
    }
    
    return FALSE;
}