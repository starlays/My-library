<?php
//TODO: security, sanitize, auto require dependencies!
//TODO: use only one retrun and a error holder!
if(isset($_POST['login'])){
	$reginfo = array($_POST['usr'], $_POST['pwd']);
	list($usr,$pwd) = $reginfo;

}

