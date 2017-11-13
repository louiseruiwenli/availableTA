<?php
require "dbConfig.php";

if($_GET['userID']){
  $userID = $_GET['userID'];
}

if($_GET['time']){
  $time = $_GET['time'];
}

if($_GET['dayOfWeek']){
  $day = $_GET['dayOfWeek'];
}
if($_GET['action'] == 'available'){
  $sql_update_available = "UPDATE Schedule SET $time = '1' WHERE UserID = '$userID' and DayOfWeek = '$day'";
  $result_available = mysqli_query($link, $sql_update_available);
  if(isset($result_available)){
    echo json_encode('Update Success');
  }else{
    echo json_encode('Update Failure');
  }
}

if($_GET['action'] == 'unavailable'){
  $sql_update_unavailable = "UPDATE Schedule SET $time = '0' WHERE UserID = '$userID' and DayOfWeek = '$day'";
  $result_unavailable = mysqli_query($link, $sql_update_unavailable);
  if(isset($result_unavailable)){
    echo json_encode('Update Success');
  }else{
    echo json_encode('Update Failure');
  }
}
?>
