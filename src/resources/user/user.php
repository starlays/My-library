<?php

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