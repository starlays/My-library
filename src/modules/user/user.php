<div>
    <form action="" method="post">
    Which book do you want to delete?<br />
    <?php
    foreach($loaded_deps as $books) {
        if(is_array($books)){
            foreach($books as $book) {
                if(isset($book['book_title'])) {
                     echo '<input type="checkbox" name="rm_books[]" value="',$book['book_title'],'" />',$book['book_title'],'<br />';
                }
            }
        }
    }
    ?>
    <input type="submit" name="delete_book" value="Remove selected books!" />
    </form>
</div>
<div>
    <form action='' method='POST' enctype="multipart/form-data">
    <fieldset>
    <legend> Add book: </legend>
    <label for='bktitle'>*Title:</label><input id='bktitle' name='book_title' type='text' />
    <label for='bkauthor'>*Author:</label><input id='bkauthor' name='book_author' type='text' />
    <label for='bkdesc'>*Description:</label><input id='bkdesc' name='book_descript' type='text' />
    <label for='bkdate'>*Date:</label><input id='bkdate' name='book_insdate' type='text' value="<?php echo date("Y-m-d"); ?>"/>
    </fieldset>
    <fieldset>
    <legend> Book atachements: </legend>
    <label for='bkcvr'>Cover image:</label><input id='bkcvr' name='book_cvrimg' type='file' />
    <label for='bkebook'>E-book:</label><input id='bkebook' name='book_ebook' type='file' />
    </fieldset>
    <input type='submit' name='usr_add_book' value='Add book' />
    </form>
<?php
if(is_numeric($page_vl_vars)) {
    switch($page_vl_vars) {
        case USER_ADBOOK_EYFLD:
            echo 'Fields marked with * are necesary.';
            break;
        case USER_NODB_INSERT:
            echo 'Can\'t insert informations in to database';
            break;
         case USER_ERR_UPLOAD:
            echo 'Can\'t upload the given files!';
            break;
        case USER_DB_INSERT_OK:
            echo 'Book added';
    }
}
?>
</div>
<div>
    <form action='' method='POST'>
    <fieldset>
    <legend> Search book: </legend>
    <label for='bktitle'>Book title:</label><input id='bktitle' name='search_title' type='text' /><br />
     </fieldset>
    <input type='submit' name='search_book' value='Search book' />
    </form>
    <?php
    if(is_array($page_vl_vars)) {
        echo 'Book Name: '.$page_vl_vars[0].'<br />';
        echo 'Author Name: '.$page_vl_vars[1].'<br />';
        echo 'Description: '.$page_vl_vars[2].'<br />';
        echo 'Added Date: '.$page_vl_vars[3].'<br />';
        echo 'Cover img.: '.$page_vl_vars[4].'<br />';
        echo 'e-Book Path: '.$page_vl_vars[5].'<br />';
    }
    ?>
</div>
