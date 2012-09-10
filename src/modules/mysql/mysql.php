<?php
$mysql_host        =    ''; //MySQL host
$mysql_user        =    ''; //MySQL user
$mysql_pass        =    ''; //MySQL pass
$DB                =    'mylibrary'; //MySQL database

$mysql_link = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $DB);

unset($mysql_host, $mysql_user, $mysql_pass, $DB);

if($mysql_link) {
    return $mysql_link;
}
else {
    return NULL;
}
