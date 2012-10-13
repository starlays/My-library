<?php
return '
    Thanks for signing up '.$reginfo['usr'].'!
    Your account has been created, you can login with the following credentials 
    after you have activated your account by pressing the url below.

    ------------------------
    Username: '.$reginfo['usr'].'
    Password: ********
    ------------------------

    Please click this link to activate your account:
    
    mylibrary/?page=register&email='.$reginfo['mail'].'&hash='.$hash.'
    ';
?>
