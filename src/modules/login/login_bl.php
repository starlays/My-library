<?php
/**
 * Constant retun when user is logged in
 */
const LOGIN_SUCCESS      = 54;
/**
 * Error constants for module authentication 
 */
const ERR_AUTH_MISSINFO  = 50;
const ERR_AUTH_NOUSER    = 51;
const ERR_AUTH_RETRVINFO = 52;
const ERR_AUTH_STARTSESS = 53;
const LOGIN_NO_ACTION    = 55;
const ERR_USERNOTACTIVE  = 56;
const LOGOUT_SUCCESS      = 90;
const LOGOUT_CANNOTSTOP   = 91;

/**
 * Status code container
 */
$status_code = NULL;

initialize_session();

if(isset($_POST['login'])){
    
    $reginfo = array($_POST['usr'], $_POST['pwd']);
    
    if(!isEmpty_array_vals($reginfo)) {
        list($username, $pass) = datafilter($reginfo);

        if(user_exists($mysql_link, $username, $pass)){
            $SQL = "SELECT id AS uid, username, first_name, last_name, mail AS e_mail, active
                    FROM `users` WHERE username='$username' AND password='$pass';";
            if($userdata = retrive_assoc($mysql_link, $SQL)) {
                if(0 !== (int)$userdata['active']){
                    $ses_key = generate_unique_str($username);
                    $_SESSION['ses_key']    = $ses_key;
                    $_SESSION['username']   = $username;
                    $_SESSION['user_ID']    = $userdata['uid'];
                    $_SESSION['first_name'] = $userdata['first_name'];
                    $_SESSION['last_name']  = $userdata['last_name'];
                    
                    unset($userdata);
                    mysqli_close($mysql_link);

                    $status_code = LOGIN_SUCCESS;
                }
                else{
                    $status_code = ERR_USERNOTACTIVE;
                }
            }
            else {
                $status_code = ERR_AUTH_RETRVINFO;
            }
        }
        else {
             $status_code = ERR_AUTH_NOUSER ;
        }
    }
    else {
        $status_code = ERR_AUTH_MISSINFO;
    }
}
else{
    $status_code = LOGIN_NO_ACTION;
}
/**
 * Logout constants
 */
if(isset($_POST['logout'])){
    
    session_unset();
    session_destroy();
    $status_code = LOGOUT_SUCCESS;

}

return array('status_code' => $status_code);