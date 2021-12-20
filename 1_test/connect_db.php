<?php

$host = 'localhost';
$dbname = 'ud2_test';
$username = 'root';
$password = '';

//MySQL/MariaDB
$dbh=new PDO('mysql:host='.$host.';dbname='.$dbname.'', $username, $password);

// PostgreSQL
//$dbh = new PDO('pgsql:host=' . $host . ';dbname=' . $dbname, $username, $password);

?>

