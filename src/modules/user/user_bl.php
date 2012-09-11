<?php
//error const
const USER_ADBOOK_EYFLD = 40;

//add book business logic
if(isset($_POST['usr_add_book'])) {

    if(!empty($_POST['book_title']) && !empty($_POST['book_author']) 
            && !empty($_POST['book_descript']) && !empty($_POST['book_insdate'])) {
        
        if($mysql_link){
            $author = mysqli_real_escape_string($mysql_link, $_POST['book_author']);
            $sql_author = "INSERT INTO `authors` (`name`) VALUES ('$author');";
            
            $book_title    = mysqli_real_escape_string($mysql_link, $_POST['book_title']);
            $book_descript = mysqli_real_escape_string($mysql_link, $_POST['book_descript']);
            $book_insdate  = mysqli_real_escape_string($mysql_link, $_POST['book_insdate']);
 
$sql = "INSERT INTO `mylibrary`.`books` 
    (`id`, `title`, `id_author`, `description`, `insert_date`, `cvr_img_path`, `e_book_path`, `id_rate`, `id_insert_user`)
    VALUES 
    (NULL, \'test\', \'3\', \'test\', \'2012-09-12\', \'\', \'\', 2, 1)";

            $sql_book = "INSERT INTO `books` (``)";
            
            //use MySQL transactions for multiple insert
            mysqli_autocommit($mysql_link, FALSE);
            mysqli_query($mysql_link, $sql_author);
            mysqli_commit($mysql_link);
            
        }
    }
    else {
        return USER_ADBOOK_EYFLD;
    }
}
else {
    return NULL;
}