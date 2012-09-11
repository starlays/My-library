<?php
// if we have an mysql connection retrive the ncessary data out of the database
if($mysql_link) {
    
    $SQL = "SELECT 
        title AS book_title, name AS author_name, description AS book_description,
        insert_date AS book_insert_date FROM `books`
        INNER JOIN `authors` ON books.id_author = authors.id;";
    
    if($result = mysqli_query($mysql_link, $SQL)) {
        if($books = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
            mysqli_free_result($result);
            mysqli_close($mysql_link);
            return $books;            
        }  
    }   
}