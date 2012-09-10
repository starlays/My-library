<form action="<?php __MODULES__.$_GET['page'].DIRECTORY_SEPARATOR.'register_bl.php'?>" method='POST'>

<fieldset>
<legend> Register Info: </legend>
<label for='fn'>* First Name:</label><input id='fn' name='fn' type='text' /><br />
<label for='ln'>* Last Name:</label><input id='ln' name='ln' type='text' /><br />
<label for='usr'>* Username:</label><input id='usr' name='usr' type='text' /><br />
<label for='mail'>* E-mail:</label><input id='mail' name='mail' type='text' /><br />
<label for='pwd'>* Password:</label><input id='pwd' name='pwd' type='password' /><br />
<label for='rpwd'>* Retype Password:</label><input id='rpwd' name='rpwd' type='password' /><br />
</fieldset>
<input type='submit' name='register' value='Register' />

</form>