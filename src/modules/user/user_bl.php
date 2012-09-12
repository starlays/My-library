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
        $sql_add_book = "
           INSERT INTO `books` (`title`, `id_author`, `description`, `insert_date`,
           `cvr_img_path`, `e_book_path`, `id_rate`, `id_insert_user`)
           VALUES ( '$book_title', (SELECT `id` FROM `authors` WHERE name='$book_author'), 
           '$book_descript', $book_insdate, $book_cvrimg, '$book_ebook', 1, 2);"; 
            //TODO: fix use id, now is inserted manualy
          
            //use MySQL transactions to be on the safe side
            mysqli_autocommit($mysql_link, FALSE);
            $insert_error = FALSE;
            //is the recived author in our database?
            if($result = mysqli_query($mysql_link, $sql_getauthor)) {
                $db_author = mysqli_fetch_row($result);
                
                if(!in_array($book_author,$db_author)) {
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
else {
    return NULL;
}