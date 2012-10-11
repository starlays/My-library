<?php
if(!(isset($_SESSION['username']) && isset($_SESSION['ses_key']))){
    echo "<form action='' method='POST'>
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
    </form>";
}

if(!is_null($status_code)){
    switch($status_code) {
        case ERR_FIELDMISS:
            echo 'Fields marked with * are necessary.';
            break;
        case ERR_PASSNOMATCH:
            echo 'The passwords are not matching.';
            break;
        case ERR_USEREXISTS:
            echo 'This user already exists.';
            break;
        case ERR_MAILEXISTS:
            echo 'This e-mail is already registered.';
            break;
        case ERR_INVALIDMAIL:
            echo 'This e-mail is invalid.';
            break;
        case REGISTER_SUCCESS:
            echo 'Registration Successful. A validation link was sent to you e-mail account, please validate your account in order to login.';
            break;
    }
}
