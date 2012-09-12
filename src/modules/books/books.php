<div id="books">
<?php
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
    echo 'No books to show.';
}
?>
</div>