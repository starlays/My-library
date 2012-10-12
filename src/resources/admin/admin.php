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

/**
 * Retrive all users from database
 * retrive_users($mysql_link)
 * 
 * @param resource $mysql_link an resource object link to the database
 * @param string $order_by the criteria by witch the books are ordered
 * @param string $type order asccendent or descendentent default ASC
 * 
 * @return array $users, the users retrived from database
 */
function retrive_users($mysql_link, $order_by, $type) {

    $SQL = "SELECT * FROM `users` WHERE 
            (`rights`='0001' OR `rights`='0011' OR `rights`='0111') 
            ORDER BY ".$order_by." ".$type.";";

    if($result = mysqli_query($mysql_link, $SQL)) {
        if($users = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
            mysqli_free_result($result);
            return $users;
        }
    }
}