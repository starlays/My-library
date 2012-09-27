<?php

// no need to add an if construct, because user module depend on this
// and that module too starts a sesion!
// but if this module start as its own it nust start a sesion!
if (initialize_session()){
    if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])
                                && is_usr_logged($_SESSION['username'])) {
        // if we have an mysql connection retrive the ncessary data out of the database
    if($mysql_link) {

        $uID = $_SESSION['user_ID'];
        $default_order = 'title';
        $default_asc = 'ASC';
        
        if(isset($_POST['reorder'])) {
            $default_order = $_POST['ordering'];
            $default_asc = $_POST['asc'];
        }
        
        $SQL = "SELECT 
            title AS book_title, name AS author_name, description AS book_description,
            insert_date AS book_insert_date FROM `books`
            INNER JOIN authors ON books.id_author = authors.id 
                WHERE id_insert_user = ".$uID." 
                    ORDER BY ".$default_order." ".$default_asc.";";
        
        if($result = mysqli_query($mysql_link, $SQL)) {
            if($books = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
                mysqli_free_result($result);
                return $books;
            }
        }
    }}
}