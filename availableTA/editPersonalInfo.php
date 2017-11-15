<?php
require "dbConfig.php";

if($_GET['username']){
  $email = $_GET['username'];
}

if($_GET['phone']){
  $phone = $_GET['phone'];
}

$sql_updatephone = "UPDATE User SET phone = '$phone' where email = '$email'";
$result = mysqli_query($link, $sql_updatephone);

if(isset($result)){
  echo json_encode('Update Success');
}else{
  echo json_encode('Update failure');
}


 ?>
