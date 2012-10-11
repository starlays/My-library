<?php
/**
 * Register module BL file
 */
/**
 * Constant retun when user is logged in
 */
const REGISTER_SUCCESS = 55;
/**
 * Error constants for module authentication 
 */
const ERR_PASSNOMATCH     = 57;
const ERR_USEREXISTS      = 58;
const ERR_FIELDMISS       = 59;
const USER_SESSIONOTSTART = 60;
const ERR_MAILEXISTS      = 61;
const ERR_INVALIDMAIL     = 62;
/**
 * Status code container
 */
$status_code = NULL;

if(initialize_session()) {
    if(isset($_POST['register'])){
        $reginfo = array(
                        'fn'   => $_POST['fn'],
                        'ln'   => $_POST['ln'],
                        'usr'  => $_POST['usr'],
                        'mail' => $_POST['mail'], 
                        'pwd'  => $_POST['pwd'],
                        'rpwd' => $_POST['rpwd'],
                    );
        $reginfo = datafilter($reginfo);

        if(!isEmpty_array_vals($reginfo)) {
            if($_POST['pwd'] === $_POST['rpwd']) {
                if(!user_exists($mysql_link, $reginfo['usr'])) {
                    if(mail_validation($reginfo['mail'])){
                        if(!mail_exists($mysql_link, $reginfo['mail'])){
                            $hash = md5(mt_rand(0,1000));
                            if(insert_new_usr($mysql_link, $reginfo,$hash)){
                                send_validation_link($reginfo['mail'],$reginfo['usr'],$hash);
                                $status_code = REGISTER_SUCCESS;
                            }
                        }
                        else{
                            $status_code = ERR_MAILEXISTS;
                        }
                    }
                    else {
                        $status_code = ERR_INVALIDMAIL;
                    }
                }
                else {
                    $status_code = ERR_USEREXISTS;
                }
            }
            else {
                $status_code = ERR_PASSNOMATCH;
            }
        }
        else {
            $status_code = ERR_FIELDMISS;
        }
    }
}
else {
    $status_code = USER_SESSIONOTSTART;
}

return array('status_code' => $status_code);