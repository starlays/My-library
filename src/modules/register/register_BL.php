<?php
//TODO: security, sanitize, auto require dependencies!
require_once __MODULES__.'mysql'.DIRECTORY_SEPARATOR.'mysql.php';
if(isset($_POST['register'])){
	$reginfo = array($_POST['fn'], $_POST['ln'], $_POST['usr'], $_POST['mail'], 
		$_POST['pwd'], $_POST['rpwd']);
	list($fn,$ln,$usr,$mail,$pwd,$rpwd) = $reginfo; 
	
	$query=mysqli_query($mysql_link,"SELECT * FROM users WHERE username='$usr'");
	$ckuser=mysqli_num_rows($query);
	
	if(0 === $ckuser){
		if($pwd === $rpwd){
			$flag = mysqli_query($mysql_link, "INSERT INTO `users`
				(`username`, `first_name`, `last_name`, `mail`, `password`) 
				VALUES 
				('$usr','$fn','$ln','$mail','$pwd')"
			);
			if($flag){ 
				return "Registration Succesfull"; 
				mysqli_close($mysql_link);
			}
			else { 
				return "error in registration".mysqli_error($mysql_link); 
			}
		}
		else {
			return 'Password did not match';
		}
	}
	else {
		return 'Users Exists';
	}
}
?>