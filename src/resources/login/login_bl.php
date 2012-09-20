<?php
//TODO: data validation
const ERR_PASSNOMATCH   = 60;
const ERR_USRPWD    = 61;
const MSG_LOGINOK = 62;
$err = NULL;
$msg = NULL;

if(isset($_POST['login'])){
    $reginfo = array($_POST['usr'], $_POST['pwd']);
    
    if(isEmpty($reginfo)) {
        list($username,$pass) = datafilter($reginfo);
        
        $SQL = "SELECT id AS uid, username, first_name, last_name, mail AS e_mail
                    FROM `users` WHERE username='$username' AND password='$pass';";
        $result = mysqli_query($mysql_link,$SQL);
        //If we have an result
        if($userdata = mysqli_fetch_assoc($result)){

            $_SESSION['is_logged_in']   = 1;
            $_SESSION['user_ID']        = $userdata['uid'];
            $_SESSION['username']       = $userdata['username'];
            $_SESSION['first_name']     = $userdata['first_name'];
            $_SESSION['last_name']      = $userdata['last_name'];
            
            unset($userdata);
            mysqli_close($mysql_link);
            
            return MSG_LOGINOK;
        }
        else {
            return ERR_PASSNOMATCH;
        }
    }
    else {
        return ERR_USRPWD;
    }
}

