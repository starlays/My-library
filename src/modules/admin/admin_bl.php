<?php
/**
 * Admin module BL file
 */
/**
 * Constant retun when user is logged in
 */
const REGISTER_SUCCESS = 450;
const ADMIN_MSGSUCCESS = 451;
/**
 * Error constants 
 */
const ERR_PASSNOMATCH     = 452;
const ERR_USEREXISTS      = 453;
const ERR_FIELDMISS       = 454;
const USER_SESSIONOTSTART = 455;
const ERR_USRNOTLOGGED    = 456;
const ERR_USRISNOADMIN    = 457;
const ERR_NOMSGSENT       = 458;
/**
 * Status code container
 */
$status_code = NULL;

if(initialize_session()) {
    if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])
                                    && is_usr_logged($_SESSION['username'])) {
        
        if(is_admin($mysql_link, $_SESSION['username'])){
            if(isset($_POST['add_user'])){
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
                            if(insert_new_usr($mysql_link, $reginfo)){
                                $status_code = REGISTER_SUCCESS;
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
            if(isset($_POST['send_admin_msg'])){
                $reginfo = array(
                        'message'   => $_POST['message'] );
                $reginfo = datafilter($reginfo);
                if(!isEmpty_array_vals($reginfo)) {
                    if(insert_new_message($mysql_link, $reginfo)){
                        $status_code = ERR_USRNOTLOGGED;
                    }
                    else {
                        $status_code = ERR_NOMSGSENT;
                    }
                }
            }
        }
        else {
            $status_code = ERR_USRISNOADMIN;
        }
    }
    else {
        $status_code = ERR_USRNOTLOGGED;
    }
}
else {
    $status_code = USER_SESSIONOTSTART;
}

return array('status_code' => $status_code);