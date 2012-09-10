<?php

$host        =    'localhost';
$user        =    '';
$pass        =    '';
$tablename   =    'mylibrary';

$mysql_link = mysqli_connect($host, $user, $pass, $tablename);

return $mysql_link;