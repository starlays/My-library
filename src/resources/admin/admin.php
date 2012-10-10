<?php
/**
 * Admin resource
 */

/**
 * Resource error constants:
 */

/**
 * Insert message into db in dadabase
 * insert_new_message($mysql_link, $message)
 *
 * @param resource $mysql_link, an resource object link to the database
 * @param string $message, the message that goes to db
 *
 * @return bool TRUE if mesage is saved in db else FALSE
 */
function insert_new_message($mysql_link,  $userinformations = array()) {
    
    $message = $userinformations['message'];
    $date =  date("Y-m-d");
    $uID = $_SESSION['user_ID'];
    
    $SQL = "INSERT INTO `admin_msg`
    (`message`, `date`, `id_admin`)
    VALUES
    ('$message','$date','$uID');";
    
    if(mysqli_query($mysql_link, $SQL)){
        return TRUE;
    }
    else {
        return FALSE;
    }
}