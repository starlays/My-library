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
    <form action="" method="POST">
    <fieldset>
    <legend> Delete simple users: </legend>
    <p>ATTENTION: Admin users will show here only if you change their rights!</p>
    <?php
        if(!is_null($users) && is_array($users)){
            foreach($users as $user) {
                if(isset($user['username'])) {
                    echo '<input type="checkbox" name="rm_users[]" value="',$user['username'],'" />',$user['username'],'<br />';
                }
            }
        }
    ?>
    </fieldset>
    <input type="submit" name="delete_user" value="Delete Users" />
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
            break;
        case ADMIN_MSGSUCCESS:
            echo 'The message was sent.';
            break;
        case ERR_NOUSERRETRIVED;
            echo 'No user retrived';
            break;
        case USERS_DELSUCCESS;
            echo 'Users were deleted';
            break;
        case ERR_DELUSERS;
            echo 'User cannot be deleted or he has books related to his account';
            break;
        case ERR_MAILEXISTS:
            echo 'This e-mail is already registered.';
            break;
        case ERR_INVALIDMAIL:
            echo 'This e-mail is invalid.';
            break;
        case ERR_SENDVALIDATION:
            echo 'The activation link wasn`t sent.';
            break;
        case ERR_NOMSGSENT:
            echo 'The message was not sent.';
    }
}
unset($status_code);
?>
</div>

