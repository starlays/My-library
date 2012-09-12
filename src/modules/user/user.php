<div>
    <form action='' method='POST'>
    <fieldset>
    <legend> Delete book: </legend>
    Select a book from a drop down or mark a book from the book listing
    </fieldset>
    <input type='submit' name='delete_book' value='Remove book' />
    </form>
</div>
<div>
    <form action='' method='POST'>
    <fieldset>
    <legend> Add book: </legend>
    <label for='bktitle'>*Title:</label><input id='bktitle' name='book_title' type='text' />
    <label for='bkauthor'>*Author:</label><input id='bkauthor' name='book_author' type='text' />
    <label for='bkdesc'>*Description:</label><input id='bkdesc' name='book_descript' type='text' />
    <label for='bkdate'>*Date:</label><input id='bkdate' name='book_insdate' type='text' value="<?php echo date("Y-m-d"); ?>"/>
    <label for='bkcvr'>Cover image:</label><input id='bkcvr' name='book_cvrimg' type='text' />
    <label for='bkebook'>E-book:</label><input id='bkebook' name='book_ebook' type='text' />
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
        case USER_DB_INSERT:
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
</div>
