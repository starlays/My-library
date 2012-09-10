<?php
$mysql_host        =    ''; //MySQL host
$mysql_user        =    ''; //MySQL user
$mysql_pass        =    ''; //MySQL pass
$table              =    'mylibrary';

$mysql_link = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $table);

unset($mysql_host, $mysql_user, $mysql_pass, $table);

if($mysql_link) {
    return $mysql_link;
}
else {
    return NULL;
}
