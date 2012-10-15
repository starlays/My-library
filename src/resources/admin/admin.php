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
 * string arrange_ban_status($user_ban_status
 * 
 * @param string $user_ban_status, user ban status revceiverd from db
 * 
 * @return string $status, witch will show the curent ban status,
 *                           to make a dynamic selection.
 */
function arrange_ban_status($user_ban_status) {
    
    $status = NULL;
    
    if(0 === (int)$user_ban_status) {
        $status = '
            <select>
                <option value="'.$user_ban_status.'">OK</option>
                <option value="1">Banned</option>
            </select>';
    }
    else {
        $status = '
            <select>
                <option value="'.$user_ban_status.'">Banned</option>
                <option value="0">OK</option>
            </select>';
    }
    return $status;
}

/**
 * Retrive all users from database
 * string arrange_ban_status($user_ban_status
 * 
 * @param string $user_ban_status, user ban status revceiverd from db
 * 
 * @return string $status, witch will show the curent ban status,
 *                           to make a dynamic selection.
 */
function arrange_rights_status($user_rights_status) {
    
    $rights = array(
        'Registered' => '0001',
        'Right2'     => '0011',
        'Right3'     => '0111',
        'Admin'      => '1111',
    );
    $html = '<select><option value="'.$user_rights_status.'">'.array_search($user_rights_status,$rights).'</option>';
    unset($rights[array_search($user_rights_status,$rights)]);
    foreach($rights as $right => $value){
        $html .= '<option value="'.$value.'">'.$right.'</option>';
    }
    $html .= '</select>';        
    return $html;
}