<?php

$host        =    "";
$user        =    "";
$pass        =    "";
$tablename   =    "";

$mysql_link = mysqli_connect($host, $user, $pass, $tablename);

return $mysql_link;