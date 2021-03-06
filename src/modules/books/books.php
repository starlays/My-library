<?php if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])){ ?>
<div id='books'>
<script>
$(document).ready(function(){
        $(".inner").prepend('<input type="checkbox" class="checkboxall"> Select/Deselect all');
        $(".checkboxall").click(function(){
            if($(".checkboxall").attr('checked')) {
                $(".checkbox").attr('checked', true);
            }
            else {
                $(".checkbox").attr('checked', false);    
            }
        })
});
</script>
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
        case ERR_RATEBOOK:
            echo 'Not rated, try again!';
            break;
        case ERR_ALREADYRATED:
            echo 'You already rated this book!';
            break;
        case SUCCESS_BOOKRATED:
            echo 'Book Rated.';
            break;
         case BOOKS_ERR_EMAILSEND:
            echo 'Error sending e-mail!';
    }
} 

    if(!is_null($books) && is_array($books)) {?>
<form class="inner" action="" method="post">
        <table border="1">
        <tr>
            <td>Check</td>
            <td>Book Title</td>
            <td>Author Name</td>
            <td>Descriptions</td>
            <td>Inserted Date</td>
            <td>Picture</td>
            <td>eBook</td>
            <td colspan="5">Rate Book</td>
        </tr>
   <?php foreach($books as $book) {
            $book_title = $book['book_title'];

            echo '<tr><td><input type="checkbox" class="checkbox" name="email_books_collection[]" value="',$book['book_title'],'" /></td>';

            foreach($book as $book_meta => $book_data) {
                if('bID' === $book_meta){
                    continue;
                };
                if(is_array($book_data)) {
                    foreach($book_data as $assets) {
                        foreach($assets as $asset) {
                            if('book_img' === $book_meta) {
                                echo '<td><img border="0" src="uploads/',$book_title,'/cvr_img/',$asset,'" width="200" height="200"></td>';
                            }
                            elseif('book_ebook' === $book_meta) {
                                echo '<td><a href="uploads/',$book_title,'/ebook/',$asset,'">',$asset,'</a></td>';
                            }
                        }
                    }
                }
                else {
                    if('cvr_img_path' !== $book_meta && 'e_book_path' !== $book_meta) {
                        echo '<td>',$book_data,'</td>';
                    }
                }
            }
            echo rate_links_gen($mysql_link,$_GET['page'],$_SESSION['user_ID'],$book['bID']);
            echo '</tr>';
        }
        unset($mysql_link);
        ?>
       <input type="submit" name="email_books" value="E-mail books to a friend!" />
       </table>
</form>    
<?php }
    else {
        echo '<p>You have no books associated with your account</p>';
    }
?>
