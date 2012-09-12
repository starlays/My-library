<?php
//TODO: security,
//TODO: use only one retrun and a error holder!
const ERR_PASSNOMATCH   = 60;
const ERR_USRPWD    = 61;
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
            session_start();
            $_SESSION['is_logged_in'] = 1;
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
mysqli_close($mysql_link);

