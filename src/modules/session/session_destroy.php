<?php
//remove all the variables in the session 
session_unset(); 
// destroy the session 
session_destroy(); 
// go to index
header('Location: index.php');

