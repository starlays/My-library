<?php if(!(isset($_SESSION['username']) && isset($_SESSION['ses_key']))){ ?>
<form action='' method='POST'>
        <fieldset>
        <legend> Login : </legend>
        <label for='usr'>Username:</label><input id='usr' name='usr' type='text' /><br />
        <label for='pwd'>Password:</label><input id='pwd' name='pwd' type='password' /><br />
        </fieldset>
        <input type='submit' name='login' value='Login' />
        </form>
<?php
}
if(!is_null($status_code)) {
    switch($status_code) {
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
        case ERR_USERNOTACTIVE:
            echo sprintf('You did not activate this user, plese verify your email. Click <a href="#">here</a> to resend the activation code. Error: %d', ERR_USERNOTACTIVE);
            break;
        case LOGIN_SUCCESS:
            echo 'You are now logged in';
    }
}
