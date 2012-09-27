<?php

if(isset($_SESSION['username']) && isset($_SESSION['ses_key'])){ 
    echo "<div id='books'>
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
    ";
    
    if(isset($page_vl_vars) && is_array($page_vl_vars)) {
        foreach($page_vl_vars as $informations) {
            echo '<div id="group_book">';
            foreach($informations as $metadata => $data){
                echo   $metadata, ' : ',$data, ' ';
            }
            echo '</div>';
        }
    }
    else { 
        echo 'You have no books corelated to your account.';
    }
}


