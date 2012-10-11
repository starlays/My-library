<?php if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])){ ?>
<div id='books'>
<form action='' method='POST'>
<fieldset>
<legend> Order your books by: </legend>
<label for='title'>Title:</label>
    <input type='radio' name='ordering' value='title' checked='yes'/>

<label for='author'>Authors:</label>
    <input type='radio' name='ordering' value='name' />

<label for='description'>Description:</label>
    <input type='radio' name='ordering' value='description' /><br />

<label for='asc'>Asc:</label>
    <input type='radio' name='asc' value='ASC' checked='yes'/>
<label for='desc'>Desc:</label>
    <input type='radio' name='asc' value='DESC' /><br />
<input type='submit' name='reorder' value='Reorder' />
</fieldset>
</form>
</div>
<?php
}
if(!is_null($status_code)){
    switch($status_code){
        case BOOKS_NOT_LOGGED:
            echo 'You are not logged in!';
            break;
        case BOOKS_ERR_EMAIL_TP:
            echo 'Email template missing!';
            break;
         case BOOKS_ERR_EMAIL_BK:
            echo 'Email template is empty!';
            break;
         case BOOKS_ERR_EMAILSEND:
            echo 'Error sending e-mail!';
            break;
    }
} 
else {
    if(!is_null($books) && is_array($books)) {?>
        <form action="" method="post">
   <?php foreach($books as $book) {
            $book_title = $book['book_title'];
            
            echo '<input type="checkbox" name="email_books_collection[]" value="',$book['book_title'],'" />';
            
            foreach($book as $book_meta => $book_data) {
                if(is_array($book_data)) {
                    foreach($book_data as $assets) {
                        foreach($assets as $asset) {
                            if('book_img' === $book_meta) {
                                echo '<img border="0" src="uploads/',$book_title,'/cvr_img/',$asset,'" width="200" height="200"><br>';
                            }
                            elseif('book_ebook' === $book_meta) {
                                echo '<a href="uploads/',$book_title,'/ebook/',$asset,'">',$asset,'</a>';
                            }
                        }
                    }
                }
                else {
                    if('cvr_img_path' !== $book_meta && 'e_book_path' !== $book_meta) {
                        echo $book_meta,' : ', $book_data, '<br>';
                    }
                }
            }
        }?>
       <input type="submit" name="email_books" value="E-mail books to a friend!" />
       </form> 
<?php }
    else {
        echo '<p>You have no books associated with your account</p>';
    }
}
?>
</div>
