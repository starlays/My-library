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
    
        list($usr,$pwd) = datafilter($reginfo);
        
        $query = "SELECT * FROM users WHERE username='$usr' AND password='$pwd'";
        $qresult = mysqli_query($mysql_link,$query);
        $ckuser = mysqli_num_rows($qresult);
        
        if(0 < $ckuser){
        
            $userdata = mysqli_fetch_row($qresult);
            
            $_SESSION['is_logged_in'] = 1;
            $_SESSION['fn'] = $userdata[2];
            $_SESSION['ln'] = $userdata[3];
            
            unset($userdata);
    
            mysqli_close($mysql_link);
            
            $msg = MSG_LOGINOK;
        }
        else {
            $err = ERR_PASSNOMATCH;
        }
    }
    else {
        $err = ERR_USRPWD;
    }
}
if(empty($err)){
    return $msg;
}
else {
    return $err;
}

