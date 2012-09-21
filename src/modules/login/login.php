<?php
if(!is_usr_logged($_SESSION['username'], $_SESSION['ses_key'])){
    echo "<form action='' method='POST'>
        <fieldset>
        <legend> Login : </legend>
        <label for='usr'>Username:</label><input id='usr' name='usr' type='text' /><br />
        <label for='pwd'>Password:</label><input id='pwd' name='pwd' type='password' /><br />
        </fieldset>
        <input type='submit' name='login' value='Login' />
        </form>";
}

if(is_numeric($page_vl_vars)) {
    switch($page_vl_vars) {
        case ERR_AUTH_MISSINFO:
            echo sprintf('Please fill your username and password! Error: %d', ERR_AUTH_MISSINFO);
            break;
        case ERR_AUTH_NOUSER:
            echo sprintf('Can\'t find provided username! Error: %d', ERR_AUTH_NOUSER);
            break;
        case ERR_AUTH_RETRVINFO:
            echo sprintf('Can\'t fetch informations from database! Error: %d', ERR_AUTH_RETRVINFO);
            break;
        case ERR_AUTH_STARTSESS:
            echo sprintf('Can\'t start the session! Error: %d', ERR_AUTH_STARTSESS);
            break;
        case LOGIN_SUCCESS:
            echo 'You are now logged in';
    }

}
