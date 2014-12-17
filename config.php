<?php

// Connection info
$host = 'localhost';
$dbname = 'zodiackingdom';
$dbuser = 'apache';
$dbpasswd = 'mapache';

// Create connection
$db = mysqli_connect($host, $dbuser, $dbpasswd, $dbname);

// Check connection
if (mysqli_connect_errno()) {
  echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
