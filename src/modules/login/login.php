<form action='' method='POST'>
<fieldset>
<legend> Login : </legend>
<label for='usr'>Username:</label><input id='usr' name='usr' type='text' /><br />
<label for='pwd'>Password:</label><input id='pwd' name='pwd' type='password' /><br />
</fieldset>
<input type='submit' name='login' value='Login' />
</form>
<?php 
//TODO: security
if(is_numeric($page_vl_vars)) {
    switch($page_vl_vars) {
        case ERR_PASSNOMATCH:
            echo 'The user/password are not valid';
            break;
        case ERR_USRPWD:
            echo 'Please enter u`r credentials';
            break;
        case MSG_LOGINOK:
            echo 'Login Successful';
            break;
    }
}
?>