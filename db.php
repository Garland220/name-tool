<?php

$link = mysql_connect('localhost', 'username', 'password');
if (!$link)
    die('Could not connect: ' . mysql_error());
//echo 'Connected successfully<br />';
//mysql_close($link);
mysql_select_db('names');

?>
