<?php
//TODO: security, 
//TODO: use only one retrun and a error holder!
const ERR_MYSQLCONN    = 50;
const ERR_PASSNOMATCH   = 51;
const ERR_USEREXISTS    = 52;
const ERR_FIELDMISS    = 53;
const MSG_REGOK    = 54;
$err = NULL;
$msg = NULL;

if(isset($_POST['register'])){
	$reginfo = array($_POST['fn'], $_POST['ln'], $_POST['usr'], $_POST['mail'], 
		$_POST['pwd'], $_POST['rpwd']);
    if(isEmpty($reginfo)) {
        list($fn,$ln,$usr,$mail,$pwd,$rpwd) = datafilter($reginfo); 
        $query = "SELECT * FROM users WHERE username='$usr'";
        $qresult = mysqli_query($mysql_link, $query);
        $ckuser = mysqli_num_rows($qresult);
        
        if(0 === $ckuser){
            if($pwd === $rpwd){
                $query = "INSERT INTO `users`
                    (`username`, `first_name`, `last_name`, `mail`, `password`) 
                    VALUES 
                    ('$usr','$fn','$ln','$mail','$pwd')";
                $flag = mysqli_query($mysql_link, $query);
                if($flag){ 
                    $msg = MSG_REGOK; 
                    mysqli_close($mysql_link);
                }
                else { 
                    $err = ERR_MYSQLCONN; 
                }
            }
            else {
                $err = ERR_PASSNOMATCH;
            }
        }
        else {
            $err = ERR_USEREXISTS;
        }
    }
    else {
        $err = ERR_FIELDMISS;
    }
}
if(empty($err)){
    return $msg;
}
else {
    return $err;
}
?>