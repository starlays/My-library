<?php
// I DO NOT FERIFY If the user is logged out because logout button will be 
// available only if the user is logge in, so TODO: 
// the logout button link should appear only if user is logged in and vice versa

session_start();

//remove all the variables in the session 
session_unset(); 
 
// destroy the session 
session_destroy(); 

// go to index
header('Location: index.php');

