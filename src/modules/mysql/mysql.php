<?php
list($mysql_host, $mysql_user, $mysql_pass, $DB) = require_once __APPROOT__ . '../config/mysql_credentials.php';

$mysql_link = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $DB);

unset($mysql_host, $mysql_user, $mysql_pass, $DB);

if($mysql_link) {
    return $mysql_link;
}
else {
    return NULL;
}
