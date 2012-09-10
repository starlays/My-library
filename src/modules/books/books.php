<div id="books">
<?php
foreach($page_vl_vars as $metadata => $data) {
    echo <<<EOT
        <div id="$metadata">
            $metadata : $data
        </div>
EOT;
    echo PHP_EOL;
}
?>
</div>