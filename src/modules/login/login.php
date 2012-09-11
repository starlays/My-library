<?php 

session_start();

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['is_logged_in'])) {
	header('Location: index.php');
}

?>
<form action='' method='POST'>

<fieldset>
<legend> Login : </legend>
<label for='usr'>Username:</label><input id='usr' name='usr' type='text' /><br />
<label for='pwd'>Password:</label><input id='pwd' name='pwd' type='password' /><br />
</fieldset>
<input type='submit' name='login' value='Login' />

</form>
<?php 
//TODO: security, sanitize, show errors
?>