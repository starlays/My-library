<?php
session_start(); 
if (isset($_SESSION['is_logged_in'])){
    //remove all the variables in the session 
    session_unset(); 
    // destroy the session 
    session_destroy(); 
    header('Location: index.php');
}
else {
    header('Location: index.php?page=login');
}
