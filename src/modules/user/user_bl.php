<?php
//error const
const USER_ADBOOK_EYFLD = 40;
const USER_NODB_INSERT  = 41;
const USER_DB_INSERT    = 42;
//add book business logic
if(isset($_POST['usr_add_book'])) {
    $required_info = array($_POST['book_title'], $_POST['book_author'], 
        $_POST['book_descript'], $_POST['book_insdate']);
    $optional_info = array($_POST['book_cvrimg'], $_POST['book_ebook']);
//TODO: Better form validation, check every case, check if field type is coresponding    
    if(isEmpty($required_info)) {
        if($mysql_link){
        $required_info = datafilter($required_info);
        $optional_info = datafilter($optional_info);
        $required_info[] = $optional_info;
        
        //TODO: Use prepared statements instead of #18-#25
        foreach($required_info as $data){
            if(is_array($data)) {
                foreach($data as $inner_data){
                    mysqli_real_escape_string($mysql_link, $inner_data);
                }
            }
            else {
                mysqli_real_escape_string($mysql_link, $data);
            }
        }

        list($book_title, $book_author, $book_descript, $book_insdate,
                list($book_cvrimg, $book_ebook)) = $required_info;
        //optional informatin default value processing
        $book_cvrimg = empty($book_cvrimg) ? NULL : $book_cvrimg;
        $book_ebook = empty($book_ebook) ? NULL : $book_ebook;
        //TODO: fix bug: when a optional field are missing insert NULL not string
        $sql_getauthor= "SELECT `name` FROM `authors` WHERE name='$book_author'";
        $sql_author   = "INSERT INTO `authors` (`name`) VALUES ('$book_author');";
        // WARNING:!!! we must not allow unregistred user to add book, uID will
        // not be set!!!
        $uID = $_SESSION['uID'];
        $sql_add_book = "
           INSERT INTO `books` (`title`, `id_author`, `description`, `insert_date`,
           `cvr_img_path`, `e_book_path`, `id_rate`, `id_insert_user`)
           VALUES ( '$book_title', (SELECT `id` FROM `authors` WHERE name='$book_author'), 
           '$book_descript', '$book_insdate', '$book_cvrimg', '$book_ebook', 1, '$uID');"; 
            //TODO: i thing the new added book should have 1 at
            // `id_rate` coresponding with rating_value.id=1 with value=0 or NULL
            // because it's a new added book that has no rate!
          
            //use MySQL transactions to be on the safe side
            mysqli_autocommit($mysql_link, FALSE);
            $insert_error = FALSE;
            
            //is the recived author in our database?
            if($result = mysqli_query($mysql_link, $sql_getauthor)) {
                $db_author = mysqli_fetch_row($result);
                
                if(!is_array($db_author)) {
                    if(!mysqli_query($mysql_link, $sql_author)) {
                        $insert_error = TRUE;
                    }
                 }
            }
            if(!mysqli_query($mysql_link, $sql_add_book)) {
                $insert_error = TRUE;
            }
            if($insert_error) {
                mysqli_rollback($mysql_link);
                mysqli_close($mysql_link);
                
                return USER_NODB_INSERT;
            }
            else {
                mysqli_commit($mysql_link);
                mysqli_close($mysql_link);
                
                return USER_DB_INSERT;
            }
        }
    }
    else {
        return USER_ADBOOK_EYFLD;
    }
}
elseif(isset($_POST['delete_book'])) {
    if(isset($_POST['rm_books'])) {
        $rm_books = datafilter($_POST['rm_books']);
        $rm_books = implode(',', $rm_books);

        $sql_dbooks = "DELETE FROM `books` WHERE `title` IN ('$rm_books');";
        mysqli_query($mysql_link, $sql_dbooks);
        mysqli_close($mysql_link);
    }
}
elseif(isset($_POST['search_book'])) {
    if(isset($_POST['search_title'])) {
        $search_title = $_POST['search_title'];
        $sql_sbooks = "SELECT title AS book_title, name AS author_name, description AS book_description,
        insert_date AS book_insert_date, cvr_img_path AS book_cvr_img_path, e_book_path AS book_ebook_path
         FROM `books` INNER JOIN `authors` ON books.id_author = authors.id  WHERE title REGEXP '".$search_title."';";
        
        $query = mysqli_query($mysql_link, $sql_sbooks);
        return mysqli_fetch_row($query);
        mysqli_close($mysql_link);
    }
}
else {
    return NULL;
}