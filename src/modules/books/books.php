<div id="books">
<?php
if(isset($page_vl_vars) && is_array($page_vl_vars)) {
    foreach($page_vl_vars as $informations) {
        foreach($informations as $metadata => $data){
        echo <<<EOT
            <div id="$metadata">
                $metadata : $data
            </div>
EOT;
        echo PHP_EOL;
        }
    }
}
else { 
    echo 'No books to show.';
}
?>
</div>