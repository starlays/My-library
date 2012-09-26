<?php
/**
 * Constant retun when user is logged in
 */
const REGISTER_SUCCESS = 55;
/**
 * Error constants for module authentication 
 */
const ERR_PASSNOMATCH  = 57;
const ERR_USEREXISTS   = 58;
const ERR_FIELDMISS    = 59;
const USER_SESSIONOTSTART = 60;

if(initialize_session()) {
    if(isset($_POST['register'])){
        $reginfo = array($_POST['fn'], $_POST['ln'], $_POST['usr'], $_POST['mail'], 
                $_POST['pwd'], $_POST['rpwd']);

        if(!isEmpty_array_vals($reginfo)) {
            if($_POST['pwd'] === $_POST['rpwd']) {
                $username = $_POST['usr'];
                if(!user_exists($mysql_link, $username)) {
                    if(insert_new_usr($mysql_link, $reginfo)){
                        
                        return REGISTER_SUCCESS;
                    }
                }
                else {
                    return ERR_USEREXISTS;
                }
            }
            else {
                return ERR_PASSNOMATCH;
            }
        }
        else {
            return ERR_FIELDMISS;
        }
    }
}
else {
    return USER_SESSIONOTSTART;
}