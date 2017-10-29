<?php
//DB details
$host = 'localhost';
$user = 'root';
$password = 'root';
$db = 'availableTA';
$port = 8889;

//Create connection and select DB
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