<?php
/**
 * Authentication resource
 */

/**
 * Resource error constants:
 */

/**
 * Check to se if the given user exists in dadabase
 * user_exists($mysql_link, $username,[$password])
 *
 * @param resource $mysql_link an resource object link to the database
 * @param string $username the user that you wish to check if exists
 * @param string $password optional param the password attached to the $username
 *
 * @return bool TRUE if user exists and otherwise FALSE
 */
function user_exists($mysql_link, $username=NULL, $password=NULL) {

    $SQL = "SELECT username FROM `users` WHERE username='$username'";

    if(func_num_args()===3) {
        if(is_string(func_get_arg(2))) {
            $SQL.= " AND password='$password'";
        }
    }
    $qresult = mysqli_query($mysql_link, $SQL);
    if($result  = mysqli_num_rows($qresult)) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Verify to se if the given data exists in dadabase
 * bool verify_data($mysql_link, $mail, $hash)
 *
 * @param resource $mysql_link an resource object link to the database
 * @param string $mail, the mail that must be check if exists
 * @param string $hash, the unique account identifier
 *
 * @return bool TRUE if data verifies otherwise FALSE
 */
function verify_data($mysql_link, $mail, $hash) {

    $SQL = "SELECT `mail`, `hash`, `active` FROM `users` 
            WHERE `mail`='$mail' AND `hash`='$hash' AND `active`='0';";
    
    $qresult = mysqli_query($mysql_link, $SQL);
    if($result  = mysqli_num_rows($qresult)) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Check to se if the given mail is already in DB
 * bool mail_exists($mysql_link, $username, $mail)
 *
 * @param resource $mysql_link an resource object link to the database
 * @param string $mail, the mail that need to be check if exists
 *
 * @return bool TRUE if mail exists, otherwise FALSE
 */
function mail_exists($mysql_link, $mail=NULL) {

    $SQL = "SELECT `mail` FROM `users` WHERE `mail`='$mail'";

    $qresult = mysqli_query($mysql_link, $SQL);
    if($result  = mysqli_num_rows($qresult)) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Activate an account
 * bool activate_account($mysql_link, $mail, $hash)
 *
 * @param resource $mysql_link an resource object link to the database
 * @param string $mail, the mail that must be check if exists
 * @param string $hash, the unique account identifier
 *
 * @return bool TRUE if activated otherwise FALSE
 */
function activate_account($mysql_link, $mail, $hash) {

    $SQL = "UPDATE users SET active='1' 
            WHERE mail='$mail' AND hash='$hash' AND active='0'";
    
    $qresult = mysqli_query($mysql_link, $SQL);

    if($qresult) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Check to se if the given mail is a valid mail
 * bool mail_validation($mail)
 *
 * @param string $mail, the mail string that need to be check
 *
 * @return bool TRUE if mail is valid, otherwise FALSE
 */
function mail_validation($mail) {
    if(preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$^", $mail)){
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Insert new registered user in to database
 *
 * @param resource $mysql_link an resource object link to the database
 * @param array $userinformations
 *
 * @return bool TRUE on success FALSE on failure
 */
function insert_new_usr($mysql_link, $userinformations = array(), $hash = NULL) {
    
    $firstname = $userinformations['fn'];
    $lastname = $userinformations['ln'];
    $username = $userinformations['usr'];
    $email = $userinformations['mail'];
    $password = $userinformations['pwd'];
    

    $SQL = "INSERT INTO `users`
    (`username`, `first_name`, `last_name`, `mail`, `password`, `hash`)
    VALUES
    ('$username','$firstname','$lastname','$email','$password','$hash');";
    if(mysqli_query($mysql_link, $SQL)){
        return TRUE;
    }
    else {
        return FALSE;
    }

}

/**
 * Insert new registered user in to database
 * bool send_mail($mail,$username,$hash = NULL,$maildata = array())
 * 
 * @param string $mail, the email where you sent the message
 * @param string $username, used to inform the user of his username
 * @param string $hash, unique string to identify the users
 * @param array $maildata, the subject, message, headers and others
 *
 * @return bool TRUE on success FALSE on failure
 */
function send_mail($username,$hash = NULL,$maildata = array()){
    if(mail($maildata['mail'], $maildata['subject'], 
         $maildata['message'], $maildata['headers'])){
        return TRUE;
    }
    else{
        return FALSE;
    }
}
/**
 * Check to see if the user is logged in
 *
 * @param $username the user that is beeing checked
 *
 * @return bool TRUE if the user is logged in FALSE otherwise
 */
function is_usr_logged($username) {
    if($_SESSION['ses_key'] === generate_unique_str($username)) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

/**
 * Generate unique string
 *
 * @param string $username username for witch the unique string is generated
 *
 * @return string the unique sha1 string
 */
function generate_unique_str($username=NULL) {
        return sha1($username);
}

/**
 * Start the session
 *
 * @param void
 *
 * @return mixed start session or False on error
 */
function initialize_session() {
    if(!isset($_SESSION)){
        return session_start();
    }
   else {
        return TRUE;
    }
}

/**
 * Destroy the sessin
 *
 * @param void
 *
 * @return bool TRUE on success otherwise FALSE
 */
function destroy_session() {
    if(session_start()) {
        if(isset($_SESSION)){
            //TODO: see php manual, add session cookie deletion
            // after that destroy the session
            session_unset();
            session_destroy();
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
 * Verify is an user has admin rights;
 *
 * @param resource $mysql_link an resource object link to the database
 * @param string $username
 *
 * @return bool TRUE on success otherwise FALSE
 */
function is_admin($mysql_link, $username) {
    
    $SQL = "SELECT COUNT(*) AS admin FROM users WHERE username ='$username' AND rights=7;";
    
    $qresult = mysqli_query($mysql_link, $SQL);
    $qresult = mysqli_fetch_assoc($qresult);
    
    if(1 === (int)$qresult['admin']) {
        return TRUE;
    }
    else {
        return FALSE;
    }
}

