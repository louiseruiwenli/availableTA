<?php
//DB details
/*
$host = 'dbserver.engr.scu.edu';
$user = 'rli';
$password = '00001172280';
$db = 'sdb_rli';
$port = 3306;

//Create connection and select DB
$link = mysqli_connect($host, $user, $password, $db) or die("Error" . mysqli_error($link));

*/

$user = 'root';
$password = 'root';
$db = 'availableTA';
$host = 'localhost';
$port = 8889;

$link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port
);


?>
