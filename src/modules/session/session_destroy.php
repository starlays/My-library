<?php
session_start();
//remove all the variables in the session 
if (isset($_SESSION['is_logged_in'])){
    header('Location: index.php');
}
else {
    header('Location: index.php?page=login');
}
