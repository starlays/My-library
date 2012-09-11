<?php
//TODO: security, sanitize
//TODO: use only one retrun and a error holder!

if(isset($_POST['login'])){
	$reginfo = array($_POST['usr'], $_POST['pwd']);
	list($usr,$pwd) = $reginfo;
	
	$query = "SELECT * FROM users WHERE username='$usr' AND password='$pwd'";
	$qresult = mysqli_query($mysql_link,$query);
	$ckuser = mysqli_num_rows($qresult);
	
	if(0 < $ckuser){
		session_start();
		$_SESSION['is_logged_in'] = 1;
	}
	else {
		echo 'userul nu exista';
	}
}
mysqli_close($mysql_link);

