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

    $SQL = "SELECT username,first_name,last_name,mail,ban_status,rights,hash,active 
            FROM `users` ORDER BY ".$order_by." ".$type.";";

    if($result = mysqli_query($mysql_link, $SQL)) {
        if($users = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
            mysqli_free_result($result);
            return $users;
        }
    }
}

/**
 * Retrive all users from database
 * string arrange_ban_status($user_ban_status,$user)
 * 
 * @param string $user_ban_status, user ban status revceiverd from db
 * @param string $user, user that has that ban status
 * 
 * @return string $html, html option list
 */
function arrange_ban_status($user_ban_status,$user) {
    
    $html = NULL;
    
    if(0 === (int)$user_ban_status) {
        $html = '
            <select name="'.$user.'_ban">
                <option selected="selected" value="'.$user_ban_status.'">OK</option>
                <option value="1">Banned</option>
            </select>';
    }
    else {
        $html = '
            <select name="'.$user.'_ban">
                <option selected="selected" value="'.$user_ban_status.'">Banned</option>
                <option value="0">OK</option>
            </select>';
    }
    return $html;
}

/**
 * Retrive all users from database
 * string arrange_rights_status($user_ban_status,$user)
 * 
 * @param string $user_rights_status, user right status received from db
 * @param string $user, user that has that right status
 * 
 * @return string $html, html option list
 */
function arrange_rights_status($user_rights_status,$user) {

    $rights = array(
        'Registered' => 1,
        'Moderator'  => 3,
        'Admin'      => 7,
    );
    $html = '<select name="'.$user.'_right"><option value="'.$user_rights_status.'">'.array_search($user_rights_status,$rights).'</option>';
    unset($rights[array_search($user_rights_status,$rights)]);
    foreach($rights as $right => $value){
        $html .= '<option value="'.$value.'">'.$right.'</option>';
    }
    $html .= '</select>';        
    return $html;
}

/**
 * UPDATE user with given data
 * bool update_user($mysql_link, $data);
 * 
 * @param resource $mysql_link, an resource object link to the database
 * @param string $users, data with user that will be updated
 * @param string $users_datas, data with update info
 * 
 * @return bool TRUE if the user were updated, otherwise FALSE
 */
function update_user($mysql_link, $users, $users_data){
    
    //use MySQL transactions to be on the safe side
    mysqli_autocommit($mysql_link, FALSE);
    
    foreach($users as $id => $user){
        $SQL = "UPDATE `users` 
               SET `ban_status`= '".$users_data[$user.'_ban']."', 
                       `rights`= '".$users_data[$user.'_right']."'
               WHERE `username`= '".$user."'";
        $result = mysqli_query($mysql_link,$SQL);
    }
    if($result){
        mysqli_commit($mysql_link);
        mysqli_close($mysql_link);
        return TRUE;
    }
    else{
        mysqli_rollback($mysql_link);
        mysqli_close($mysql_link);
        return FALSE;
    }
}