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
    }
} 
else {
    if(!is_null($books) && is_array($books)) {
        foreach($books as $book) {
        
            $book_title = $book['book_title'];
            echo '<div id="group_book">';

            foreach($book as $book_metadata => $book_data){
                
                if(!is_null($books_covers)) {

                    foreach($books_covers as $cvr_data) {
                        if(isset($cvr_data[$book_metadata])
                            && $cvr_data['book_title'] === $book_data) {
                            
                            foreach($cvr_data['book_img'] as $image) {
                                echo '<img border="0" src="uploads/'.$book_title.'/cvr_img/'.$image.'" width="200" height="200">';
                            }
                            break;                        
                            
                            }
                    }
                }
                
               echo   $book_metadata, ' : ',$book_data, ' ';
            }
            echo '</div>';
        }
    }
}
