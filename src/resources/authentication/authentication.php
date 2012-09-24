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
 * Insert new registered user in to database
 *
 * @param resource $mysql_link an resource object link to the database
 * @param array $userinformations
 *
 * @return bool TRUE on success FALSE on failure
 */
function insert_new_usr($mysql_link, $userinformations = array()) {
    list($username, $firstname, $lastname,$email, $password)=$userinformations;

    $SQL = "INSERT INTO `users`
    (`username`, `first_name`, `last_name`, `mail`, `password`)
    VALUES
    '$username','$firstname','$lastname','$email','$password'";

    if($mysqli_query($mysql_link, $SQL)) {
        return TRUE;
    }
    else {
        return FALSE;
    }

}

/**
 * Check to see if the user is logged in
 *
 * @param $username the user that is beeing checked
 * @param $sha_key the unique key of the user generated per session
 *
 * @return bool TRUE if the user is logged in FALSE otherwise
 */
function is_usr_logged($username, $ses_key) {
    if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])) {
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
        return FALSE;
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
