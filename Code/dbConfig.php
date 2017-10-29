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
//$conn=mysql_connect("$host:$port",$user,$password) or die (mysql_error());
//mysql_select_db($db, $conn) or die (mysql_error());


?>