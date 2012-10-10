<?php if(isset($_SESSION['username']) && isset($_SESSION['ses_key']) && $status_code !== 457) { ?>
<div>
    <form action="" method="POST">
    <fieldset>
    <legend> Add New User: </legend>
    <label for="fn">* First Name:</label><input id="fn" name="fn" type="text" /><br />
    <label for="ln">* Last Name:</label><input id="ln" name="ln" type="text" /><br />
    <label for="usr">* Username:</label><input id="usr" name="usr" type="text" /><br />
    <label for="mail">* E-mail:</label><input id="mail" name="mail" type="text" /><br />
    <label for="pwd">* Password:</label><input id="pwd" name="pwd" type="password" /><br />
    <label for="rpwd">* Retype Password:</label><input id="rpwd" name="rpwd" type="password" /><br />
    </fieldset>
    <input type="submit" name="add_user" value="Add User" />
    </form>
</div>
<div>
    <form action="" method="POST">
    <fieldset>
    <legend> Send important messages to all users: </legend>
        <textarea placeholder="Type u`r txt here!" name="message" cols="35" rows="8"></textarea>
    </fieldset>
    <input type="submit" name="send_admin_msg" value="Send Message" />
    </form>
</div>
<div>
<?php }

if(!is_null($status_code)) {
    switch($status_code) {
        case ERR_FIELDMISS:
            echo 'Fields marked with * are necessary.';
            break;
        case ERR_PASSNOMATCH:
            echo 'The passwords are not matching';
            break;
        case ERR_USEREXISTS:
            echo 'This user already exists';
            break;
        case ERR_USRISNOADMIN :
            echo 'You are not allowed here!';
            break;
        case ERR_USRNOTLOGGED :
            echo 'You are not logged in!';
            break;
        case REGISTER_SUCCESS:
            echo 'Registration Successful';
    }
}
unset($status_code);
?>
</div>

