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
const ERR_NOUSERRETRIVED  = 458;
const USERS_DELSUCCESS    = 459;
const ERR_DELUSERS        = 460;
const ERR_MAILEXISTS      = 461;
const ERR_INVALIDMAIL     = 462;
const ERR_SENDVALIDATION  = 463;
const SUCCES_USRUPDATED   = 464;
const ERR_NOUSERRETRIVED  = 465;

/**
 * Status code container
 */
$status_code = NULL;
/**
 * Status users container
 */
$users = NULL;

if(initialize_session()) {
    if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])
                                    && is_usr_logged($_SESSION['username'])) {
        
        if(is_admin($mysql_link, $_SESSION['username'])){
            
            // retrive users from db
            if($mysql_link) {
                $users  = retrive_users($mysql_link, 'username', 'ASC');
            }
            else {
                $status_code = ERR_NOUSERRETRIVED;
            }
            
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
                            if(mail_validation($reginfo['mail'])){
                                if(!mail_exists($mysql_link, $reginfo['mail'])){
                                    $hash = md5(mt_rand(0,1000));
                                    if(insert_new_usr($mysql_link, $reginfo,$hash)){
                                        
                                        $maildata['mail'] = $reginfo['mail'];
                                        $maildata['subject'] = 'MyLibrary account validation';
                                        $maildata['message'] = '';
                                        $maildata['headers'] = 'From:noreply@mylibrary.ro' . "\r\n";

                                        if(send_mail($reginfo['usr'],$hash,$maildata)){
                                            $status_code = REGISTER_SUCCESS;
                                        }
                                        else{
                                            $status_code = ERR_SENDVALIDATION;
                                        }
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
            if(isset($_POST['send_admin_msg'])){
                $reginfo = array(
                        'message'   => $_POST['message'] );
                $reginfo = datafilter($reginfo);
                if(!isEmpty_array_vals($reginfo)) {
                    if(insert_new_message($mysql_link, $reginfo)){
                        $status_code = ADMIN_MSGSUCCESS;
                    }
                    else {
                        $status_code = ERR_NOMSGSENT;
                    }
                }
            }
            if(isset($_POST['delete_user'])){
                if(isset($_POST['rm_users'])){
                    
                    $rm_users = datafilter($_POST['rm_users']);
                    $rm_users = implode("','", $rm_users);

                    $SQL = "DELETE FROM `users` WHERE `username` IN ('$rm_users');";
                    
                    if(mysqli_query($mysql_link, $SQL)){
                        $status_code = USERS_DELSUCCESS;
                        mysqli_close($mysql_link);
                    }
                    else{
                        $status_code = ERR_DELUSERS;
                        mysqli_close($mysql_link);
                     }   
                    
                    
                }
            }
            if(isset($_POST['update_user'])){
                if(!empty($_POST['rm_users'])){
                    foreach($_POST['rm_users'] as $index => $username){
                           $users_data[$username.'_ban'] = $_POST[$username.'_ban'];
                           $users_data[$username.'_right'] = $_POST[$username.'_right'];
                    }
                    if(update_user($mysql_link, $_POST['rm_users'],$users_data)){
                        $status_code = SUCCES_USRUPDATED;
                    }
                    else{
                        $status_code = ERR_NOUSRUPDATED;
                    }
                }
                else {
                    $status_code = ERR_NOUSERRETRIVED;
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

return array(
                'status_code' => $status_code,
                'users' => $users,
            );