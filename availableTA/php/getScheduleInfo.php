<?php
require "dbConfig.php";

if($_GET['userID']){
  $userID = $_GET['userID'];
}

if($_GET['time']){
  $time = $_GET['time'];
}

$week_array = array("M","T","W","R","F");
foreach ($week_array as $day){
  $sql_getSchedule = "SELECT $time FROM Schedule WHERE UserID = '$userID' and DayOfWeek='$day'";
  $result = mysqli_query($link, $sql_getSchedule);
  if(isset($result)){
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
  }else{
    echo json_encode('Retrieving data failure');
  }

 ?>
