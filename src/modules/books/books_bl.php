<?php
// if we have an mysql connection retrive the ncessary data out of the database
if($mysql_link) {
    
    $SQL = "SELECT * FROM `books`";
    
    if($result = mysqli_query($mysql_link, $SQL)) {
        if($books = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return $books;            
        }  
    }
}