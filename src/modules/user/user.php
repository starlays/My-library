<?php if(isset($_SESSION['username']) && isset($_SESSION['ses_key']) && is_usr_logged($_SESSION['username'])) { ?>
<div>
<p>Messages from Admins</p>
<?php
    if(!is_null($admin_messages) && is_array($admin_messages)){
        
        foreach($admin_messages as $admin_message) {
            echo '<p>',$admin_message['message'],', date added:',$admin_message['date'],', by ',$admin_message['admin_name'],'.';
        }
    }
?>
</div>
<div>
      <form action="" method="post">
      <p>Which book do you want to delete?</p>
<?php
if(!is_null($books_list) && is_array($books_list)){
    foreach($books_list as $book) {
        if(isset($book['book_title'])) {
             echo '<input type="checkbox" name="rm_books[]" value="',$book['book_title'],'" />',$book['book_title'],'<br />';
        }
    }
}
?>
<input type="submit" name="delete_book" value="Remove selected books!" />
</form>
</div>
<div>
    <form action="" method="POST" enctype="multipart/form-data">
    <fieldset>
    <legend> Add book: </legend>
    <label for="bktitle">*Title:</label><input id="bktitle" name="book_title" type="text" />
    <label for="bkauthor">*Author:</label><input id="bkauthor" name="book_author" type="text" />
    <label for="bkdesc">*Description:</label><input id="bkdesc" name="book_descript" type="text" />
    <label for="bkdate">*Date:</label><input id="bkdate" name="book_insdate" type="text" value="<?php echo date("Y-m-d"); ?>"/>
    </fieldset>
    <fieldset>
    <legend> Book atachements: </legend>
    <label for="bkcvr">Cover image:</label><input id="bkcvr" name="book_cvrimg" type="file" accept="image/x-png, image/gif, image/jpeg"/>
    <label for="bkebook">E-book:</label><input id="bkebook" name="book_ebook" type="file" accept="application/pdf"/>
    </fieldset>
    <input type="submit" name="usr_add_book" value="Add book" />
    </form>
    <?php
    if(!is_null($cvr_img_status) && USER_CVR_MIME_ERR === $cvr_img_status) { 
        echo 'Cover image file not valid! ';
        
    }
    if(!is_null($ebook_status) && USER_EBOOK_MIME_ERR === $ebook_status) { 
       echo 'Ebook file not valid! ';
        
    } ?>
    </div>
    <div>
    <form action="" method="POST">
    <fieldset>
    <legend> Search book: </legend>
    <label for="bktitle">Book title:</label><input id="bktitle" name="search_title" type="text" /><br />
     </fieldset>
    <input type="submit" name="search_book" value="Search book" />
    </form>
<?php 
}
if(!is_null($searched_books) && is_array($searched_books)) {
    foreach($searched_books as $book) {
            echo 'Book Name: '.  $book['book_title'].'<br />';
            echo 'Author Name: '.$book['author_name'].'<br />';
            echo 'Description: '.$book['book_description'].'<br />';
            echo 'Added Date: '. $book['book_insert_date'].'<br />';
            echo 'Cover img.: '. $book['book_cvr_img_path'].'<br />';
            echo 'e-Book Path: '.$book['book_ebook_path'].'<br />';
    }
}
if(!is_null($status_code)) {
    switch($status_code) {
        case USER_ADBOOK_EYFLD:
            echo 'Fields marked with * are necesary.';
            break;
        case USER_NODB_INSERT:
            echo 'Can\'t insert informations in to database';
            break;
        case USER_ERR_UPLOAD:
            echo 'Can\'t upload the given files!';
            break;
        case USER_NOT_LOGGED_IN:
            echo 'You are not logged in!';
            break;
        case USER_DB_INSERT_OK:
            echo 'Book added';
    }
}
?>
</div>